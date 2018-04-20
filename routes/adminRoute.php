<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*-------------------this can be accessed by without login---------------------*/
Route::group(['prefix' =>Config::get('constants.admin_prefix'),'namespace' => 'AdminSite'], function () {
    
    
    Route::get('/login','LoginController@showLoginForm');
    Route::post('/login','LoginController@login');
    Route::get('/password/reset','LoginController@resetPassword');
    Route::get('/','HomeController@index');
    Route::get('/home','HomeController@index');
    Route::post('/logout','LoginController@logout');  
    
    
});