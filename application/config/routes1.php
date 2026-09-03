<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller']='webpage/application_status';
$route['student/login']='webpage/student_login';
$route['404_override']='';
$route['translate_uri_dashes']=FALSE;
$route['registration-step1']='webpage/registration_step1';
$route['forgot-password']='webpage/forgot_password';
$route['support']='webpage/admission_support';
$route['registration-confirmation/(:any)']='webpage/registration_confirmation/$1';
$route['student/registration-step1/preview']='webpage/registration_preview_step1';
$route['student/logout']='webpage/student_logout';
$route['student/registration-step1/edit']='webpage/registration_edit_step1';
$route['student/registration-step2']='webpage/registration_step2';
$route['student/registration-step2/preview']='webpage/registration_preview_step2';
$route['student/registration-step2/edit']='webpage/registration_edit_step2';
$route['student/registration-step3']='webpage/registration_step3';
$route['student/registration-payment']='webpage/registration_payment';
$route['student/document-preview']='webpage/document_preview';
$route['student/admit-card/(:any)']='webpage/student_admit_card/$1';


$route['master/users/logout']='master/login/logout';
$route['master']='master/login';
$route['master/admin']='master/master/manage_admins';
$route['master/account']='master/login/admin_account';
$route['master/registration/manage']='master/user/manage_registration';
$route['master/paymentcomp/manage']='master/user/manage_paycompreg';

$route['master/rollno/ut']='master/user/manage_paycompreg_ut';
$route['master/rollno/allindia']='master/user/manage_paycompreg_allindia';
$route['master/rollno/dfda']='master/user/manage_paycompreg_dfda';
$route['master/rollno/ne']='master/user/manage_paycompreg_ne';


$route['master/registration/view/(:num)']='master/user/registration_view/$1';
$route['student/payment-status']='webpage/bank_payresponse';
$route['student/payment-status/(:any)']='webpage/payment_failed/$1';
$route['student/payment-overview/(:any)']='webpage/payment_overview/$1';
$route['master/registration/edit-generalinfo/(:num)']='master/user/edit_generalinfo/$1';
$route['master/registration/edit-eduinfo/(:num)']='master/user/edit_eduinfo/$1';
$route['master/registration/edit-document/(:num)']='master/user/edit_document/$1';
$route['master/registration/edit-payment/(:num)/(:num)']='master/user/edit_payment/$1/$2';

$route['master/application-print/(:num)']='master/user/application_print/$1';
$route['master/registration/assign-rollno/(:num)']='master/user/assign_roll/$1';
$route['master/registration/print-status/(:num)']='master/user/change_print_status/$1';
$route['master/admitcard-print/(:num)']='master/user/admitcard_print/$1';








