<?php
ob_start();
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller']='Webpage/online_payment';
$route['404_override']='';
$route['translate_uri_dashes']=FALSE;
/************ Default Page ************/
$route['default_controller']='Webpage/frontpage';
$route['create-account']='Webpage/create_account';
$route['create-account/success/(:any)']='Webpage/create_account_status/$1';
$route['login']='Webpage/login_account';
$route['dashboard']='Webpage/frontpage';
$route['my-profile']='Webpage/my_profile';
$route['logout']='Webpage/account_logout';
$route['transactions/donation']='Transaction_Controller/manage_donations';
$route['transactions/donation/(:any)']='Transaction_Controller/view_donation/$1';
$route['transactions/chola-booking']='Transaction_Controller/manage_cholabooking';
$route['transactions/chola-booking/(:any)']='Transaction_Controller/view_cholabooking/$1';
$route['transactions/room-booking']='Transaction_Controller/manage_roombooking';
$route['transactions/room-booking/(:any)']='Transaction_Controller/view_roombooking/$1';
$route['transactions/hawan-booking']='Transaction_Controller/manage_hawanbooking';
$route['transactions/hawan-booking/(:any)']='Transaction_Controller/view_hawanbooking/$1';
$route['terms-and-conditions']='Webpage/terms_conditions';
$route['change-password']='Webpage/change_password';
$route['forgot-password']='Webpage/forgot_password';

/************ Online Donation ***********/
$route['online-donation']='Donationpage_Controller/online_donation';
$route['online-donation/overview/(:any)']='Donationpage_Controller/donation_overview/$1';
//$route['online-donation/success']='Donationpage_Controller/payment_status';
//$route['online-donation/success/(:any)']='Donationpage_Controller/payment_status_preview/$1';
//$route['online-donation/failure']='Donationpage_Controller/donation_failure';
$route['online-donation/status/(:any)']='Donationpage_Controller/donation_status/$1';

$route['online-donation/worldline/response']='Donationpage_Controller/worldline_donation_response';
$route['donationverify']='Donationverify/index';
$route['online-donation/no-response']='Donationpage_Controller/no_response';





/*********** Chola Booking *************/
$route['online-chola-booking']='Cholapage_Controller/chola_booking_step';
$route['online-chola-booking/step1']='Cholapage_Controller/chola_booking_step1';
$route['online-chola-booking/step2/(:any)']='Cholapage_Controller/chola_booking_step2/$1';
$route['online-chola-booking/verify-otp/(:any)']='Cholapage_Controller/chola_booking_verifyotp/$1';
#$route['online-chola-booking/step3/(:any)']='Cholapage_Controller/chola_booking_step1_1/$1';
$route['online-chola-booking/overview/(:any)']='Cholapage_Controller/chola_booking_payment/$1';


$route['online-chola-booking/success']='Cholapage_Controller/payment_status_chola';
$route['online-chola-booking/success/(:any)']='Cholapage_Controller/chola_status_preview/$1';
$route['online-chola-booking/failure']='Cholapage_Controller/cholapayment_failure';
$route['online-chola-booking/status/(:any)']='Cholapage_Controller/cholapayment_status/$1';
$route['online-chola-booking/worldline/response']='Cholapage_Controller/worldline_chola_response';
$route['online-chola-booking/no-response']='Cholapage_Controller/no_response';
$route['cholaverify']='Cholaverify/index';



/*********** Hawan Booking **************/
$route['hawan-booking']='Hawanpage_Controller/hawan_booking_step1';
$route['hawan-booking/time-slots']='Hawanpage_Controller/hawan_booking_step2';
$route['hawan-booking/overview/(:any)']='Hawanpage_Controller/hawan_booking_step3/$1';

$route['hawan-booking/success']='Hawanpage_Controller/payment_status_hawan';
$route['hawan-booking/success/(:any)']='Hawanpage_Controller/hawan_success_preview/$1';
$route['hawan-booking/failure']='Hawanpage_Controller/hawanpayment_failure';
$route['hawan-booking/status/(:any)']='Hawanpage_Controller/hawan_fail_preview/$1';

/*********** Room Booking **************/
$route['roomverify']='Roomverify/index';
$route['room-booking']='Roomres_Controller/room_booking';
$route['room-booking/step1']='Roomres_Controller/room_booking_step1';
$route['room-booking/step2/(:any)']='Roomres_Controller/room_book_step2/$1';

$route['room-booking/status/(:any)']='Roomres_Controller/roombook_status/$1';
/*$route['room-booking/failure']='Roomres_Controller/roompayment_failure';
$route['room-booking/success']='Roomres_Controller/roompayment_failure';*/
$route['room-booking/worldline/response']='Roomres_Controller/worldline_booking_response';

//$route['room-booking/success/(:any)']='Roomres_Controller/roombook_success_preview/$1';
//$route['room-booking/status/(:any)']='Roomres_Controller/roombook_fail_preview/$1';




$route['online-services/donation']='Services_Controller/services_donation';
$route['online-services/chola-booking']='Services_Controller/services_cholabooking';
$route['online-services/hawan-booking']='Services_Controller/services_hawanbooking';
$route['online-services/room-booking']='Services_Controller/services_roombooking';


$route['payment-notify']='Notify_Controller/payment_notify';
/*$route['payment-status']='Webpage/bank_payresponse';
$route['payment-status/(:any)']='Webpage/payment_status/$1';
$route['payment-failed/(:any)']='Webpage/payment_failed/$1';*/
$route['master']='master/admin_controller/ad_login';
$route['master/login']='master/Admin_Controller/ad_login';
$route['master/dashboard']='master/Admin_Controller/admin_dashboard';
$route['master/logout']='master/Admin_Controller/admin_logout';
$route['master/profile']='master/Admin_Controller/admin_profile';

$route['master/user/manage']='master/User_Controller/manage_user';
$route['master/user/view/(:num)']='master/User_Controller/view_user/$1';
$route['master/user/remove/(:num)']='master/User_Controller/remove_user/$1';

$route['master/donation/manage']='master/Donation_Controller/manage_donation';
$route['master/donation/view/(:num)']='master/Donation_Controller/view_donation/$1';


$route['master/date-setting/manage']='master/Datesetting_Controller/manage_datesetting';
$route['master/date-setting/add-new']='master/Datesetting_Controller/add_datesetting';
$route['master/date-setting/edit/(:num)']='master/Datesetting_Controller/edit_datesetting/$1';

/********* Chola ************/

// $route['master/chola-booking/manage']='master/Chola_Controller/manage_chola_booking';
$route['master/manage/mata-mansa-devi/chola_booking']='master/Chola_Controller/manage_mansa_devi_mandir';
$route['master/manage/patiala-mandir/chola_booking']='master/Chola_Controller/manage_patiala_mandir';
$route['master/manage/sati-mata-mandir/chola_booking']='master/Chola_Controller/manage_sati_mata_mandir';
$route['master/manage/kali-mata-mandir/chola_booking']='master/Chola_Controller/manage_kali_mata_mandir';
$route['master/manage/chandi-mata-mandir/chola_booking']='master/Chola_Controller/manage_chandi_mata_mandir';
$route['master/chola-booking/manage']='master/Chola_Controller/manage_chola_booking';
$route['master/chola-booking/view/(:any)']='master/Chola_Controller/view_cholabooking/$1';
$route['master/chola-booking/search']='master/Chola_Controller/search_chola/$1';
$route['master/chola-booking/searchlist/(:any)']='master/Chola_Controller/search_cholalist/$1';

/******* Chola Booking ********/
$route['master/chola-booking']='master/CbmasterController/chola_book_step1';
$route['master/chola-booking/overview/(:any)']='master/CbmasterController/chola_book_step2/$1';



$route['master/chola-booking/worldline/response/(:any)']='master/CbmasterController/worldline_chola_response/$1';
$route['master/chola-booking/status/(:any)']='master/CbmasterController/chola_book_status/$1';


/* Hawan Booking ********/
$route['master/hawan-booking/manage']='master/Hawan_Controller/manage_hawan_booking';
$route['master/hawan-booking/view/(:num)']='master/Hawan_Controller/view_hawan_booking/$1';

/**** Room Booking ********/
$route['master/room-booking/manage']='master/Room_Controller/manage_room_booking';
$route['master/room-booking/view/(:num)']='master/Room_Controller/view_room_booking/$1';

/********** Chola Date Settings ***/
$route['master/chola-datemgmt/manage']='master/CholadatesettingController/manage_datesetting';
$route['master/chola-datemgmt/add']='master/CholadatesettingController/add_datesetting';
$route['master/chola-datemgmt/remove/(:any)']='master/CholadatesettingController/remove_datesetting/$1';




/****************** Cron Jobs *****************/
$route['update/chola-payment-hold']='Payment_Cron/manage_chola_paymenthold';
?>


