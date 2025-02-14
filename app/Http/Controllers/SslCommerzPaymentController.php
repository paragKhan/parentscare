<?php

namespace App\Http\Controllers;

use App\Mail\Admin\OrderBooking as OrderBookingAdmin;
use App\Mail\User\OrderBooking as OrderBookingUser;
use App\Models\GlobalPackageSubscription;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Mail;

class SslCommerzPaymentController extends Controller
{

    public static function getPaymentUrl($order)
    {
        $post_data = array();
        $post_data['total_amount'] = $order->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $order->transaction_id; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = auth()->user()->name;
        $post_data['cus_email'] = auth()->user()->name;
        $post_data['cus_add1'] = auth()->user()->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "BD";
        $post_data['cus_phone'] = auth()->user()->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "";
        $post_data['ship_add1'] = "";
        $post_data['ship_add2'] = "";
        $post_data['ship_city'] = "";
        $post_data['ship_state'] = "";
        $post_data['ship_postcode'] = "";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Health care service";
        $post_data['product_category'] = "Health care service";
        $post_data['product_profile'] = "non-physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "";
        $post_data['value_b'] = "";
        $post_data['value_c'] = "";
        $post_data['value_d'] = "";

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        return response()->json(json_decode($payment_options));
    }


    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                Order::where('transaction_id', $tran_id)->first()->orderable()->update(['status' => 'ongoing']);

                $params = 'payment_type=' . $request->card_type;
                $params .= '&&amount=' . $request->amount;
                $params .= '&&transaction_id=' . $request->tran_id;

                $order = Order::where('transaction_id', $tran_id)->first();
                $orderable = $order->orderable;

                if ($orderable instanceof GlobalPackageSubscription) {
                    (new SMSOTPController())->sendMessage(
                        $orderable->user->phone,
                        'বুকিং এর জন্য ধন্যবাদ। প্যারেন্টসকেয়ার লিমিটেড এর সাথে থাকুন।');
                } else {
                    (new SMSOTPController())->sendMessage(
                        '88' . strrev(substr(strrev($orderable->phone), 0, 11)),
                        'বুকিং এর জন্য ধন্যবাদ। প্যারেন্টসকেয়ার লিমিটেড এর সাথে থাকুন।');
                }

                try {
                    Mail::send(new OrderBookingAdmin($order->orderable));
                    Mail::send(new OrderBookingUser($order->orderable));
                } catch (\Exception $exception) {

                }

                return redirect('http://parents-care-client.vercel.app/payment/success?' . $params);
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            $params = 'payment_type=' . $request->card_type;
            $params .= '&&amount=' . $request->amount;
            $params .= '&&transaction_id=' . $request->tran_id;

            return redirect('http://parents-care-client.vercel.app/payment/success?' . $params);
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            return redirect('https://parents-care-client.vercel.app/payment/failed');
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            return redirect('https://parents-care-client.vercel.app/payment/cancel');
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order table against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    Order::where('transaction_id', $tran_id)->first()->orderable()->update(['status' => 'ongoing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
