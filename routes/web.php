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

Route::get('/','StoreController@welcome')->name('home');
Auth::routes();
Route::any('/registerStore', 'StoreController@registerStore')->name('registerStore');
Route::any('/contact', 'StoreController@contact')->name('contact');
Route::post('/productsfindout', 'StoreController@search')->name('findanywhere');
Route::any('/allproduct', 'HomeController@allproduct')->name('allproduct');
Route::any('/productByCategorie{id}', 'HomeController@productByCategorie')->name('productByCategorie');
Route::any('/find{tag}', 'HomeController@findbytag')->name('findbytag');
Route::any('/productDetails{id}', 'HomeController@productDetails')->name('productDetails');



Route::get('/profile', 'HomeController@profile')->name('profile');
Route::any('/updateprofile', 'HomeController@updateprofile')->name('updateprofile');

Route::any('/updateprofileinfos', 'HomeController@updateprofileinfos')->name('updateprofileinfos');

Route::group(['middleware' => 'buyer'], function () {

Route::post('/productDetails/comment{id}', 'HomeController@comment')->name('comment');
Route::any('/addtocart{id}', 'HomeController@addtocart')->name('addtocart');
Route::any('/mycart', 'HomeController@mycart')->name('mycart');
Route::any('/myCheckouts', 'HomeController@myCheckouts')->name('myCheckouts');
Route::any('/deleteitem{id}', 'HomeController@deleteitem')->name('deleteitem');
Route::post('/sendmessage{id}{iid}', 'HomeController@sendmessage')->name('sendmessage');
Route::get('/pdf_bill{id}','HomeController@bill')->name('pdf');
Route::any('/wichlist', 'HomeController@wichlist')->name('wichlist');

Route::any('/deletewich', 'HomeController@deletewich')->name('deletewich');

Route::any('/addtowich{id}', 'HomeController@addtowich')->name('addtowich');



});

Route::group(['middleware' => 'admin'], function () {
   
Route::any('/store', 'HomeController@store')->name('store');
Route::any('/addtostore', 'HomeController@addtostore')->name('addtostore');
Route::any('/deleteProduct{id}', 'HomeController@deleteProduct')->name('deleteProduct');
Route::any('/updateProduct{id}', 'HomeController@updateProduct')->name('updateProduct');

});