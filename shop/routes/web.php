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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/login/login','Login\LoginController@login');
Route::get('/login/logout','Login\LoginController@logout');
Route::post('/login/dologin','Login\LoginController@dologin');
Route::get('/','Index\IndexController@index');
Route::get('/index/proinfo','Index\IndexController@proinfo');
Route::get('/index/prolist','Index\IndexController@prolist');
Route::post('/cart/buycart','Cart\CartController@buycart');
Route::get('/cart/buycar','Cart\CartController@buycar');
Route::post('/cart/dopay','Cart\CartController@dopay');
Route::get('/cart/pay','Cart\CartController@pay');
Route::get('/cart/address.html','Cart\CartController@address');
Route::get('/index/user','Index\IndexController@user');
Route::post('/cart/addpay','Cart\CartController@addpay');
Route::get('/cart/success','Cart\CartController@success');
Route::get('/pays/pays','Carts\AliPayController@pay');
Route::get('/carts/returl','Carts\AliPayController@returl');
Route::get('/carts/notify_url','Carts\AliPayController@aliNotify');