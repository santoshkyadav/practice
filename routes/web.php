<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

// Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
// Route::get('/user_dashboard', 'HomeController@user_dashboard')->name('userDashboard');

//----------------customer controller-----------------//
Route::get('/customer', 'customerController@index')->name('customerlogin');
Route::post('/customer/user_giude', 'customerController@customer_login')->name('home-page');
route::get('/customer/home-page', 'customerController@show')->name('show');
Route::post('/customer/functionPhotos', 'customerController@functionPhotos')->name('functionPhotos');
Route::post('/customer/customer_function_update', 'customerController@customer_function_update')->name('customer_function_update');
Route::post('/customer/Comment_photo', 'customerController@Comment_photo')->name('Comment_photo');
Route::post('/customer/Select_photo', 'customerController@Select_photo')->name('Select_photo');
Route::get('/customer/logout', 'customerController@logout')->name('log');
Route::post('/customer/finalsubmitmsg', 'customerController@finalsubmitmsg')->name('finalsubmit');
//----------------customer controller-----------------//

Auth::routes();

//----------------studio register controller-----------------//
Route::get('/studio_Register', 'StudioregisterController@index')->name('studio_Register');
//Route::get('/', 'StudioregisterController@index')->name('studio_Register');
Route::post('/registerStudio', 'StudioregisterController@create')->name('registerStudio');
Route::post('/verifyOtp', 'StudioregisterController@verifyOtp')->name('verifyOtp');
Route::post('resendOtp', 'StudioregisterController@resendOtp')->name('resendOtp');
Route::post('changeMobile', 'StudioregisterController@changeMobile')->name('changeMobile');
Route::get('/change_mobileNumber', 'StudioregisterController@mobileChangepage')->name('mobileChangepage');
Route::get('/otp', 'StudioregisterController@backtoOtp')->name('backtoOtp');
//----------------studio register controller-----------------//

//----------------studio login controller-----------------//
Route::get('/studio_Login', 'StudioLoginController@index')->name('studio_Login');
Route::post('/studio-dashboard', 'StudioLoginController@loginStudio')->name('loginStudio');
Route::get('/user_dashboard', 'StudioLoginController@user_dashboard')->name('userDashboard');
Route::get('/studioLogout', 'StudioLoginController@studioLogout')->name('studioLogout');
Route::post('verifyStudio', 'StudioLoginController@verifyStudio')->name('verifyStudio');
// Route::get('/home', 'HomeController@index')->name('home');

//----------------studio forget mobile no. controller-----------------//
Route::get('/forgetPassword', 'StudioForgetpasswordController@index')->name('forgetPassword');
Route::post('/reset', 'StudioForgetpasswordController@changePassword')->name('changePassword');
Route::get('/resetpassword', 'StudioresetPasswordController@index')->name('resetpassword');
Route::post('/passwordreset', 'StudioresetPasswordController@passwordReset')->name('passwordReset');

//----------------studio dashboard controller-----------------//
Route::get('/user_dashboard/clientdetail', 'StudioController@clients')->name('eventPage');
Route::get('/user_dashboard/customer/viewCustomer', 'StudioController@viewCustomer')->name('viewCustomer');
Route::get('/customer/view', 'customerController@customer_login')->name('view-page');
Route::post('photo_delete', 'StudioController@deletePhoto')->name('deletePhoto');
Route::get('/user_dashboard/export/{id}', 'StudioController@export');
Route::get('/user_dashboard/software', 'StudioController@displaySoftware');
Route::get('/user_dashboard/templatesummary/template/{date}', 'StudioController@displaytemplate')->name('template');
Route::get('/user_dashboard/templatesummary', 'StudioController@templatesummary');
Route::post('/payment', 'StudioController@paymentgateway')->name('paymentgateway');
Route::post('finalsubmitsync', 'StudioController@finalsubmitsync')->name('finalsubmitsync');

//----------------Admin controller-----------------//
Route::get('/admin', 'AdminController@index')->name('admin');
Route::post('/admin_login', 'AdminController@login_admin')->name('admin-login');
Route::get('/admin_dashboard', 'AdminController@dashboard')->name('dashboard'); //studio table
Route::get('/distributor', 'AdminController@distributor');//disributor table
Route::post('/update_distributor', 'AdminController@update_distributor');

Route::post('/insert_distributor', 'AdminController@insert_distributor');// update distributor
Route::get('/delete_distributor', 'AdminController@delete_distributor');

//----------------view customer of studio--------------------------//
Route::get('admin/studio/customers', 'AdminController@studioviewCustomers')->name('viewCustomers');
Route::post('admin/studio/deletecustomers', 'AdminController@studiodeleteCustomer')->name('studiodeleteCustomer');
Route::post('admin/studio/updatecustomers', 'AdminController@studioupdateCustomer')->name('studioupdateCustomer');

//---------------studio delete and update--------------------------//
Route::get('admin/studio_list/delete={id}', 'AdminController@deleteStudio')->name('deleteStudio');
Route::post('admin/studio_list', 'AdminController@updateStudio')->name('updateStudio');

//---------------customer view delete and update--------------------------//
Route::get('/admin/customers', 'AdminController@customerTable')->name('customers'); //customer table
Route::get('admin/customers/delete={id}', 'AdminController@deleteCustomer')->name('deleteCustomer');
Route::post('admin/customers', 'AdminController@updateCustomer')->name('updateCustomer');

//---------------function delete and update--------------------------//
Route::get('/admin/eventname', 'AdminController@functionNameTable')->name('eventname'); //functionname table
Route::get('admin/eventname/delete={id}', 'AdminController@deletefunctionname')->name('deletefunctionname');
Route::post('admin/eventname', 'AdminController@updatefunctionname')->name('updatefunctionname');

//---------------payment delete and update--------------------------//
Route::get('admin/paymentdetails', 'AdminController@paymentDetails')->name('paymentDetails'); //payment table
Route::post('admin/paymentdetails', 'AdminController@updatePayment')->name('updatePayment');

//---------------view customer function--------------------------//
Route::get('admin/customer/functions', 'AdminController@viewCustomerFunctions')->name('viewfunctions');
Route::get('admin/customer/deletefunctions', 'AdminController@deleteCustomerfunction')->name('deleteCustomerfunction');
Route::post('admin/customer/updatefunctions', 'AdminController@updateCustomerfunction')->name('updateCustomerfunction');

//---------------view function pics--------------------------//
Route::get('admin/function/Images', 'AdminController@viewFunctionsImages')->name('viewfunctions');
Route::get('admin/function/deleteImages', 'AdminController@deleteFunctionsImages')->name('deleteFunctionsImages');
Route::post('admin/function/updateImages', 'AdminController@updateFunctionsImages')->name('updateFunctionsImages');
Route::get('admin/logout', 'AdminController@logout')->name('adminlogout');

//---------------payment delete and update--------------------------//
Route::get('admin/paymentform', 'AdminController@paymentForm')->name('paymentForm');
Route::post('admin/formsubmit', 'AdminController@paymentFormSubmit')->name('paymentFormSubmit');
Route::get('admin/paymentUserlist', 'AdminController@cashpaymentUserlist')->name('cashpaymentUserlist'); //cash payment table
Route::post('admin/paymentUserupdate', 'AdminController@cashPaymentUpdate')->name('cashPaymentUpdate');
Route::get('admin/addtemplate', 'AdminController@addTemplateForm')->name('addTemplateForm');