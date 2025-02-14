<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaregiverAppointmentRequest;
use App\Http\Requests\StoreDoctorAppointmentRequest;
use App\Http\Requests\StoreForeignMedicalAppointmentRequest;
use App\Http\Requests\StoreHomeSampleAppointmentRequest;
use App\Http\Requests\StoreNurseAppointmentRequest;
use App\Http\Requests\StorePatientGuideAppointmentRequest;
use App\Http\Requests\StoreTherapistAppointmentRequest;
use App\Http\Requests\UpdateUserInfoRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\Admin\OrderBooking as AdminOrderBooking;
use App\Mail\User\OrderReceived as UserOrderReceived;
use App\Models\GlobalPackage;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = new User();

        if ($request->has('name')) {
            $users = $users->where('name', 'LIKE', "%{$request->name}%");
        }

        $users = $users->paginate(20)->through(function ($row) {
            return [
                "id" => $row->id,
                "name" => $row->name,
                "email" => $row->email,
                "phone" => $row->phone,
                "is_active" => $row->is_active,
                "appointments" => collect([
                    $row->doctorAppointments,
                    $row->careGiverAppointments,
                    $row->foreignMedicalAppointments,
                    $row->homeSampleAppointments,
                    $row->nurseAppointments,
                    $row->patientGuideAppointments,
                    $row->therapistAppointments,
                ])->flatten()
            ];
        });

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->update($validated);

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function updateInfo(UpdateUserInfoRequest $request)
    {
        $validated = $request->validated();

        auth()->user()->update($validated);

        return response()->json(auth()->user());
    }

    public function getCareGiverAppointment(StoreCaregiverAppointmentRequest $request)
    {
        $validated = $request->validated();

        $order = DB::transaction(function () use ($validated) {
            $appointment = auth()->user()->careGiverAppointments()->create($validated);
            $order = $appointment->order()->create([
                'amount' => round(($validated["price"] - ($validated["discount"] / 100) * $validated["price"]) * $validated['duration'], 2),
                'transaction_id' => uniqid()
            ]);

            return $order->refresh();
        });

        try {
            Mail::queue(new  AdminOrderBooking($order->orderable));
            Mail::queue(new UserOrderReceived($order->orderable));
            (new SMSOTPController())->sendMessage(
                '88' . strrev(substr(strrev($order->orderable->phone), 0, 11)),
                'বুকিং এর জন্য ধন্যবাদ। প্যারেন্টসকেয়ার লিমিটেড এর সাথে থাকুন।');
        } catch (\Exception $exception) {

        }

        $paymentUrl = SslCommerzPaymentController::getPaymentUrl($order);

        return response()->json(['payment_gateway' => $paymentUrl, 'order' => $order->load('orderable')]);
    }

    public function getDoctorAppointment(StoreDoctorAppointmentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $order = DB::transaction(function () use ($validated) {
            $appointment = auth()->user()->doctorAppointments()->create($validated);
            $order = $appointment->order()->create([
                'amount' => round($validated["price"] - ($validated["discount"] / 100) * $validated["price"], 2),
                'transaction_id' => uniqid()
            ]);

            return $order->refresh();
        });

        try{
            Mail::queue(new AdminOrderBooking($order->orderable));
            Mail::queue(new UserOrderReceived($order->orderable));
            (new SMSOTPController())->sendMessage(
                '88' . strrev(substr(strrev($order->orderable->phone), 0, 11)),
                'বুকিং এর জন্য ধন্যবাদ। প্যারেন্টসকেয়ার লিমিটেড এর সাথে থাকুন।');
        }catch(\Exception $exception){

        }


        $paymentUrl = SslCommerzPaymentController::getPaymentUrl($order);

        return response()->json(['payment_gateway' => $paymentUrl, 'order' => $order->load('orderable')]);
    }

    public function getForeignMedicalAppointment(StoreForeignMedicalAppointmentRequest $request)
    {
        $validated = $request->validated();

        $appointment = DB::transaction(function () use ($validated) {
            return auth()->user()->foreignMedicalAppointments()->create($validated);
        });

        try {
            Mail::queue(new AdminOrderBooking($appointment));
        } catch (\Exception $exception) {

        }

        return response()->json($appointment);
    }

    public function getHomeSampleAppointment(StoreHomeSampleAppointmentRequest $request)
    {
        $validated = $request->validated();

        $order = DB::transaction(function () use ($validated) {
            $appointment = auth()->user()->homeSampleAppointments()->create($validated);
            $order = $appointment->order()->create([
                'amount' => round($validated["price"] - ($validated["discount"] / 100) * $validated["price"], 2),
                'transaction_id' => uniqid()
            ]);

            return $order->refresh();
        });

        try {
            Mail::queue(new AdminOrderBooking($order->orderable));
            Mail::queue(new UserOrderReceived($order->orderable));
            (new SMSOTPController())->sendMessage(
                '88' . strrev(substr(strrev($order->orderable->phone), 0, 11)),
                'বুকিং এর জন্য ধন্যবাদ। প্যারেন্টসকেয়ার লিমিটেড এর সাথে থাকুন।');
        } catch (\Exception $exception) {

        }

        $paymentUrl = SslCommerzPaymentController::getPaymentUrl($order);

        return response()->json(['payment_gateway' => $paymentUrl, 'order' => $order->load('orderable')]);
    }

    public function getNurseAppointment(StoreNurseAppointmentRequest $request)
    {
        $validated = $request->validated();

        $order = DB::transaction(function () use ($validated) {
            $appointment = auth()->user()->nurseAppointments()->create($validated);
            $order = $appointment->order()->create([
                'amount' => round(($validated["price"] - ($validated["discount"] / 100) * $validated["price"]) * $validated['duration'], 2),
                'transaction_id' => uniqid()
            ]);

            return $order->refresh();
        });

        try {
            Mail::queue(new AdminOrderBooking($order->orderable));
            Mail::queue(new UserOrderReceived($order->orderable));
            (new SMSOTPController())->sendMessage(
                '88' . strrev(substr(strrev($order->orderable->phone), 0, 11)),
                'বুকিং এর জন্য ধন্যবাদ। প্যারেন্টসকেয়ার লিমিটেড এর সাথে থাকুন।');
        } catch (\Exception $exception) {

        }

        $paymentUrl = SslCommerzPaymentController::getPaymentUrl($order);

        return response()->json(['payment_gateway' => $paymentUrl, 'order' => $order->load('orderable')]);
    }

    public function getPatientGuideAppointment(StorePatientGuideAppointmentRequest $request)
    {
        $validated = $request->validated();

        $order = DB::transaction(function () use ($validated) {
            $appointment = auth()->user()->patientGuideAppointments()->create($validated);
            $order = $appointment->order()->create([
                'amount' => round(($validated["price"] - ($validated["discount"] / 100) * $validated["price"]) * $validated['duration'], 2),
                'transaction_id' => uniqid()
            ]);

            return $order->refresh();
        });

        try {
            Mail::queue(new AdminOrderBooking($order->orderable));
            Mail::queue(new UserOrderReceived($order->orderable));
            (new SMSOTPController())->sendMessage(
                '88' . strrev(substr(strrev($order->orderable->phone), 0, 11)),
                'বুকিং এর জন্য ধন্যবাদ। প্যারেন্টসকেয়ার লিমিটেড এর সাথে থাকুন।');
        } catch (\Exception $exception) {

        }

        $paymentUrl = SslCommerzPaymentController::getPaymentUrl($order);

        return response()->json(['payment_gateway' => $paymentUrl, 'order' => $order->load('orderable')]);
    }

    public function getTherapistAppointment(StoreTherapistAppointmentRequest $request)
    {
        $validated = $request->validated();

        $order = DB::transaction(function () use ($validated) {
            $appointment = auth()->user()->therapistAppointments()->create($validated);
            $order = $appointment->order()->create([
                'amount' => round(($validated["price"] - ($validated["discount"] / 100) * $validated["price"]) * $validated['duration'], 2),
                'transaction_id' => uniqid()
            ]);

            return $order->refresh();
        });

        try {
            Mail::queue(new AdminOrderBooking($order->orderable));
            Mail::queue(new UserOrderReceived($order->orderable));
            (new SMSOTPController())->sendMessage(
                '88' . strrev(substr(strrev($order->orderable->phone), 0, 11)),
                'বুকিং এর জন্য ধন্যবাদ। প্যারেন্টসকেয়ার লিমিটেড এর সাথে থাকুন।');
        } catch (\Exception $exception) {

        }

        $paymentUrl = SslCommerzPaymentController::getPaymentUrl($order);

        return response()->json(['payment_gateway' => $paymentUrl, 'order' => $order->load('orderable')]);
    }

    public function buyGlobalPackage(GlobalPackage $globalPackage)
    {
        $order = DB::transaction(function () use ($globalPackage) {
            $subscription = auth()->user()->globalPackageSubscriptions()->create([
                'global_package_id' => $globalPackage->id,
                'discount' => $globalPackage->discount,
                'share' => $globalPackage->share,
                'price' => $globalPackage->price
            ]);
            $order = $subscription->order()->create([
                'amount' => round($globalPackage["price"] - ($globalPackage["discount"] / 100) * $globalPackage["price"], 2),
                'transaction_id' => uniqid()
            ]);

            return $order->refresh();
        });

        try {
            Mail::queue(new AdminOrderBooking($order->orderable));
        } catch (\Exception $exception) {

        }

        $paymentUrl = SslCommerzPaymentController::getPaymentUrl($order);

        return response()->json(['payment_gateway' => $paymentUrl, 'order' => $order->load('orderable')]);
    }

    public function appointments(Request $request)
    {
        switch ($request->t) {
            case 'care_giver':
                return response()->json(auth()->user()->careGiverAppointments);
            case 'doctor':
                return response()->json(auth()->user()->doctorAppointments);
            case 'foreign_medical':
                return response()->json(auth()->user()->foreignMedicalAppointments);
            case 'home_sample':
                return response()->json(auth()->user()->homeSampleAppointments);
            case 'nurse':
                return response()->json(auth()->user()->nurseAppointments);
            case 'patient_guide':
                return response()->json(auth()->user()->patientGuideAppointments);
            case 'therapist':
                return response()->json(auth()->user()->therapistAppointments);
            case 'subscriptions':
                return response()->json(auth()->user()->globalPackageSubscriptions);
            default:
                return response()->json([]);
        }
    }

}
