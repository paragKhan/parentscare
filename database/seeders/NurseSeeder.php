<?php

namespace Database\Seeders;

use App\Models\Nurse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NurseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nurse::insert(array(
            array('id' => '2','name' => 'Mst. Shuma Akter','email' => 'Shuma@gmail.com','password' => '$2y$10$AiKgX85hMf5GO.QV7BoT6O5QPOuNChVebOvxF1Ss.zaSqnPPzILKO','phone' => '01304055100','designation' => 'Diploma Nurse','dob' => '1996-11-11 00:00:00','gender' => 'Female','location' => 'Mirpur','is_special' => '1','bio' => 'Diploma in nursing science and midwifery','photo' => 'https://bbox.parentscare.xyz/uploads/CcaON48NjD.1643183313.png','price' => '1800','discount' => '10','share' => '20','availabilities' => 'Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-26 13:51:38','updated_at' => '2022-01-26 13:51:38'),
            array('id' => '3','name' => 'Puja Rani Das','email' => 'puja@gmail.com','password' => '$2y$10$Wpre.lJ3DkwP0uAvj.5JEuGP8Z3hAT/EcdSTUM9EP4D8Lyi6w5ce.','phone' => '01644991606','designation' => 'B.Sc. in nursing','dob' => '1998-11-12 00:00:00','gender' => 'Female','location' => 'Puran Dhaka,DMC area','is_special' => '1','bio' => 'B.Sc. in nursing
Dhaka Nursing college Girls \' Hall,Dhaka','photo' => 'https://bbox.parentscare.xyz/uploads/46aut1j952.1643183657.png','price' => '1800','discount' => '10','share' => '20','availabilities' => 'Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-26 13:57:19','updated_at' => '2022-01-26 13:57:19'),
            array('id' => '4','name' => 'Mst.Hosneara Hena','email' => 'hosnearahena8@gmail.com','password' => '$2y$10$9n4nSUyJ2X52eM/ceE5it.ZC51y0QvsDOZzKaQb/6iZdk5lxtfQtS','phone' => '01301378874','designation' => 'B.Sc. in nursing','dob' => '1999-11-11 00:00:00','gender' => 'Female','location' => 'Puran Dhaka,DMC area','is_special' => '1','bio' => 'Mst.Hosneara Hena
Education :B.Sc. in nursing
Address :Dhaka Nursing College Girl\'s Hostel,Dhaka
Zone:Dhaka Medical College &Hospital','photo' => 'https://bbox.parentscare.xyz/uploads/U3feR3Schl.1643183863.png','price' => '1800','discount' => '10','share' => '20','availabilities' => 'Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-26 14:01:29','updated_at' => '2022-01-26 14:01:29'),
            array('id' => '5','name' => 'Mst Lisrat Lepe','email' => 'lipi@gmail.com','password' => '$2y$10$kto5aQPYLHrASFtMpri6iODwa/m4lRDYG1.SPDE8UXiCtf1HcydR6','phone' => '01706535043','designation' => 'Senior Stuff Nurse','dob' => '1992-11-11 00:00:00','gender' => 'Female','location' => 'Azimpur,Lalbag','is_special' => '1','bio' => 'Senior Stuff Nurse, BSMMU','photo' => 'https://bbox.parentscare.xyz/uploads/UyHwmnIKbN.1643186599.png','price' => '2000','discount' => '0','share' => '20','availabilities' => 'Saturday,Sunday,Monday,Sunday,Monday,Thursday,Friday,Tuesday,Wednesday','is_active' => '1','created_at' => '2022-01-26 14:46:54','updated_at' => '2022-01-26 14:46:54'),
            array('id' => '6','name' => 'Md Zahidul Islam','email' => 'zahidtmnc1995@gmail','password' => '$2y$10$Pj33RYgUUvYI0eS.dkTVeOSPw5d/54nw4tUT14qEEGOwCoNOAUpW6','phone' => '01768666001','designation' => 'Nursing Officer','dob' => '1988-11-11 00:00:00','gender' => '1','location' => 'Nazimuddin Road, Dhaka.','is_special' => '1','bio' => 'Education: P.Bsc
Designation: Nursing Officer','photo' => 'https://bbox.parentscare.xyz/uploads/qkn3tResOh.1643186843.png','price' => '2000','discount' => '10','share' => '18','availabilities' => 'Saturday,Sunday,Monday,Friday,Thursday,Wednesday','is_active' => '1','created_at' => '2022-01-26 14:49:33','updated_at' => '2022-01-26 14:49:33'),
            array('id' => '7','name' => 'Palash Sarkar','email' => 'sarkar@gmail.com','password' => '$2y$10$MtBTnPe7iEZzYyCVZEqwfuyyJrbGiCTFeEaSuKzVT6pjJqsWN5lr6','phone' => '01706535043','designation' => 'Senior Staff Nurse','dob' => '1978-11-11 00:00:00','gender' => '1','location' => 'Azimpur,Lalbag','is_special' => '1','bio' => 'Senior Staff Nurse,Dhaka Medical College Hospital','photo' => 'https://bbox.parentscare.xyz/uploads/07kq3nQLCQ.1643187006.png','price' => '2000','discount' => '10','share' => '20','availabilities' => 'Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-26 14:52:02','updated_at' => '2022-01-26 14:52:02'),
            array('id' => '8','name' => 'Md. Sohel Rana','email' => 'sl.tanvirms@gmail.com','password' => '$2y$10$elnJsJnB4O57uwlmuQFUCuShHM2XX5lA33CEqSYs5fvg0t59gQVc.','phone' => '01722349697','designation' => 'Junior Staff Nurse','dob' => '1999-11-11 00:00:00','gender' => '1','location' => 'Tejgaon','is_special' => '1','bio' => 'BNMC REG NO 66031','photo' => 'https://bbox.parentscare.xyz/uploads/1DoUQoVGty.1643187237.png','price' => '1200','discount' => '0','share' => '25','availabilities' => 'Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-26 14:59:29','updated_at' => '2022-01-26 14:59:29'),
            array('id' => '9','name' => 'Suman Kumar Sarkar','email' => 'sumonsarkardmch@gmail.com','password' => '$2y$10$ClkUZQouyYJeuGwbnucAKeF0VPwDgGQUtnji38C.pS9wYXeKSZYVW','phone' => '01782988008','designation' => 'MSC in Nursing','dob' => '1993-11-11 00:00:00','gender' => '1','location' => 'Shahbag','is_special' => '1','bio' => 'MSC in Nursing Science,
patients-focused Senior staff nurse with in-depth knowledge of nursing procedures and medical equipment. Responsible and caring professional trained in emergency room and skillful in assessing,evaluating and setting nursing care objectives.','photo' => 'https://bbox.parentscare.xyz/uploads/PmNUSGjh7X.1643188730.png','price' => '2000','discount' => '0','share' => '25','availabilities' => 'Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-26 15:30:31','updated_at' => '2022-01-26 15:30:31'),
            array('id' => '10','name' => 'Shirin Shila','email' => 'shila@gmail.com','password' => '$2y$10$xXo5R1k9kLbuVWkzOMqN9e52EqUfU6.iSoyIsuoZErMesL3RfkZ52','phone' => '01819916308','designation' => 'junior stuff nurse','dob' => '1999-11-11 00:00:00','gender' => 'Female','location' => 'Dhanmondi','is_special' => '1','bio' => 'Shirin Shila,
junior stuff nurse
Dhanmondi.','photo' => 'https://bbox.parentscare.xyz/uploads/L9liwpZveG.1643189506.png','price' => '1800','discount' => '10','share' => '20','availabilities' => 'Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-26 15:34:11','updated_at' => '2022-01-26 15:34:11'),
            array('id' => '11','name' => 'mst. Rina Akter','email' => 'rina@gmail.com','password' => '$2y$10$z2qm9/kBp4maYxBPPBbxbOk9i5GbjUExQCcb.KYAMVlzhVR9upmqG','phone' => '01770720368','designation' => 'Junior Staff Nurse','dob' => '1999-11-11 00:00:00','gender' => 'Female','location' => 'Shahbag','is_special' => '1','bio' => 'Junior Staff Nurse','photo' => 'https://bbox.parentscare.xyz/uploads/XVLjAIO7yC.1643189771.png','price' => '1600','discount' => '10','share' => '20','availabilities' => 'Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-26 15:38:23','updated_at' => '2022-01-26 15:38:23'),
            array('id' => '12','name' => 'Mst. Nazmin Nahar,','email' => 'mstnazminnaharS4@gmail.com','password' => '$2y$10$Lg4qAjXaBq1uR0leDiBUeeBoXgEDCswEj3MG.qXvayqckJJ/eOtVW','phone' => '+8801797682411','designation' => 'junior stuff nurse','dob' => '1999-11-11 00:00:00','gender' => 'Female','location' => 'Mirpur','is_special' => '1','bio' => 'junior stuff nurse','photo' => 'https://bbox.parentscare.xyz/uploads/bA8ZZldMMF.1643189929.png','price' => '1500','discount' => '0','share' => '20','availabilities' => 'Saturday,Sunday,Monday,Wednesday,Tuesday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-26 15:41:22','updated_at' => '2022-01-26 15:41:22'),
            array('id' => '13','name' => 'Tamanna Siddiqua Monisha','email' => 'monisha@gmail.com','password' => '$2y$10$9rlC3eDF8Wq5DZyZKN4eC.phwYwgH4aOxZT4kkJhWfmNvIaKFxGq6','phone' => '01642584055','designation' => 'Senior Stuff Nurse','dob' => '1991-11-11 00:00:00','gender' => 'Female','location' => 'Azimpur,Lalbag','is_special' => '1','bio' => 'To get an appropriate position that best fits according to my knowledge,skills & ability(Specially in nursing)
where i could provide the standard quality of patient care and seek opportunity to achieve the institutional/organizational goal.','photo' => 'https://bbox.parentscare.xyz/uploads/fEsSajQSIU.1643190117.png','price' => '2000','discount' => '10','share' => '20','availabilities' => 'Saturday,Sunday,Monday,Tuesday,Wednesday,Friday,Thursday','is_active' => '1','created_at' => '2022-01-26 15:53:44','updated_at' => '2022-01-26 15:53:44'),
            array('id' => '14','name' => 'Md.Rakib Hossen','email' => 'rakib@gmail.com','password' => '$2y$10$V2he/f1GGGh8QV/ojoFyAuHHZhBcf3lFHIrO1Ac1zC4a7jyPlVMBu','phone' => '01706535043','designation' => 'Senior Staff Nurse','dob' => '1999-11-11 00:00:00','gender' => '1','location' => 'Shahbagh','is_special' => '1','bio' => 'Senior Staff Nurse,Dhaka Medical College Hospital','photo' => 'https://bbox.parentscare.xyz/uploads/uf3M7gnFFV.1643190884.png','price' => '1500','discount' => '0','share' => '20','availabilities' => 'Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-26 16:04:49','updated_at' => '2022-01-26 16:04:49'),
            array('id' => '15','name' => 'Ektiar Leton','email' => 'liton2@gmail.com','password' => '$2y$10$LWHaz9cuBgHxSjCv60goXOJrwjDkSo1Xw9lOATZ2N7UENhRzpwg62','phone' => '01706535043','designation' => 'Senior Stuff Nurse','dob' => '1988-11-11 00:00:00','gender' => '1','location' => 'Dhanmondi','is_special' => '1','bio' => 'Senior Staff Nurse DMC','photo' => 'https://bbox.parentscare.xyz/uploads/0e8jAk2C70.1643193169.png','price' => '1600','discount' => '5','share' => '20','availabilities' => 'Saturday,Sunday,Monday,Wednesday,Tuesday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-26 16:38:49','updated_at' => '2022-01-26 16:38:49'),
            array('id' => '16','name' => 'Md.Tasikul Islam Mizan','email' => 'tasikulislam569@gmail.com','password' => '$2y$10$aXf3o.EI8fzy5ssNPDblcOTr.ZUP/rCqFSLWLCCAxSENShl3eHV72','phone' => '01737778068','designation' => 'Junior Staff Nurse','dob' => '1999-11-11 00:00:00','gender' => 'Female','location' => 'Puran Dhaka,DMC area','is_special' => '1','bio' => 'B.Sc. in nursing 3rd year
Address : Dhaka Nursing college Boys Hall,Dhaka','photo' => 'https://bbox.parentscare.xyz/uploads/HSnfWAlORV.1643193550.png','price' => '1200','discount' => '0','share' => '20','availabilities' => 'Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-26 16:41:22','updated_at' => '2022-01-26 16:41:22'),
            array('id' => '17','name' => 'Edoward Hembrom','email' => 'oviedoward1997@gmail.com','password' => '$2y$10$pdVqhxYciR/FeIFG.NzheOHhVqcyS/2jgkULGbk/davzHzH.Ab0A.','phone' => '01775316600','designation' => 'Junior Staff Nurse','dob' => '1998-11-11 00:00:00','gender' => '1','location' => 'Nazimuddin Road, Dhaka.','is_special' => '1','bio' => 'B.Sc. in nursing 3rd year
Dhaka Nursing college Boys Hall,Dhaka','photo' => 'https://bbox.parentscare.xyz/uploads/c2Q1sCvdM9.1643193703.png','price' => '1200','discount' => '0','share' => '20','availabilities' => 'Saturday,Sunday,Monday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-26 16:44:42','updated_at' => '2022-01-26 16:44:42'),
            array('id' => '18','name' => 'Monir hossain','email' => 'monirnue@gmail.com','password' => '$2y$10$p2TZ1hgiop6f732nqxK6x.bSBwd1Wf8smwQCvUxi7bfM4bwcaSiUC','phone' => '01775656707','designation' => 'Senior Stuff Nurse','dob' => '1987-11-11 00:00:00','gender' => '1','location' => 'Badda','is_special' => '1','bio' => 'Senior Staff nurse,Square Hospital .','photo' => 'https://bbox.parentscare.xyz/uploads/lwvRDchRr0.1643194048.png','price' => '1500','discount' => '10','share' => '20','availabilities' => 'Saturday,Monday,Wednesday,Friday','is_active' => '1','created_at' => '2022-01-26 16:49:37','updated_at' => '2022-01-26 16:49:37'),
            array('id' => '19','name' => 'MD. Anowar Hossen','email' => 'anowarislam021@gmail.com','password' => '$2y$10$MtOATAMBn544fmezNsbMGuEgNY6kLBUIYvSClwdNY4KRqXTyU/Y4e','phone' => '01923719299','designation' => 'Senior Stuff Nurse','dob' => '1996-04-02 00:00:00','gender' => '1','location' => 'Kallyanpur, Shyamoli,Mohammadpur','is_special' => '1','bio' => 'To build up my career in the field of \'\'Nursing\'\' in any reputed organization to work with honesty,sincerity and to learn grows by integration my knowledge and skills and to add value to that organization to be served and explore my potentials an eventually take greater responsibilities and to face the challange of the time.','photo' => 'https://bbox.parentscare.xyz/uploads/bD7FMJtQEJ.1643260497.png','price' => '1800','discount' => '10','share' => '20','availabilities' => 'Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-27 11:28:35','updated_at' => '2022-01-27 11:28:35'),
            array('id' => '20','name' => 'Shamima Akter','email' => 'shamima@gmail.com','password' => '$2y$10$I7Tebrr6PWhKPjX7hyDVTO1YUbiyP88oDFjRjeMh.BgZWzp4/XhQ.','phone' => '01727359662','designation' => 'Junior Staff Nurse','dob' => '1999-11-11 00:00:00','gender' => 'Female','location' => 'Mirpur,Mirpur DOHS,Pallabi','is_special' => '1','bio' => 'Professional home Care Nurse,
Diploma in Nursing Science and Midwifery','photo' => 'https://bbox.parentscare.xyz/uploads/9X2DHGZL7p.1643274130.jpeg','price' => '1600','discount' => '10','share' => '30','availabilities' => 'Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-27 15:05:08','updated_at' => '2022-01-27 15:05:08'),
            array('id' => '21','name' => 'Sharmin Akter','email' => 'Sharmin@gmail.com','password' => '$2y$10$FJcqxlBwftFhJjoxaXDyTu2iPgucsWyJqbQ28wUQhQgTteTBqS2bm','phone' => '01924298594','designation' => 'Junior Staff Nurse','dob' => '1998-11-11 00:00:00','gender' => 'Female','location' => 'Mirpur,Mirpur DOHS,Pallabi','is_special' => '1','bio' => 'Professional Caregiver Homecare Nursing Services.
diploma in nursing Science and Midwifery','photo' => 'https://bbox.parentscare.xyz/uploads/VRaWJJuYzw.1643274344.jpeg','price' => '1500','discount' => '10','share' => '1500','availabilities' => 'Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday','is_active' => '1','created_at' => '2022-01-27 15:08:59','updated_at' => '2022-01-27 15:08:59')
        ));
    }
}
