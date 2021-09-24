<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/register', 'API\UserController@create')->name('registerUser');

Route::get('/login', 'API\UserController@login')->name('loginuser');

Route::get('/save_login', 'API\UserController@save_login')->name('saveloginuser');

Route::get('/customer/payment', 'API\UserController@Payment')->name('Payment');

Route::get('/studio/studioVerify', 'API\UserController@studioVerify')->name('studioVerify');

Route::get('/customer/login', 'API\CustomController@login')->name('logincustomer');

Route::get('/customer/addCustomer', 'API\CustomController@addCustomer')->name('addCustomer');

Route::get('/customer/addFunction', 'API\CustomController@addFunctionName')->name('addFunctionName');
Route::get('/customer/photoDetails', 'API\CustomController@photoDetails')->name('photoDetails');

Route::get('/customer/selectedImages', 'API\CustomController@selectedImages')->name('selectedImages');
Route::get('/customer/activateCustomer', 'API\CustomController@activateCustomer')->name('activateCustomer');
Route::get('/uscd', 'API\UserController@StudioComputerDetails')->name('StudioComputerDetails');

Route::post('/test', 'API\UserController@save_userUrl')->name('test');