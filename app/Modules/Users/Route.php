<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Route::group(['prefix' =>Config::get('constants.admin_prefix'),'middleware'=>'admin','namespace' => 'Users\Controllers'], function () {
//    listing user start
    Route::get('/user-manage/allusers','UserManageController@allusers');
    Route::get('/user-manage/newuser','UserManageController@newuser');
    Route::post('/user-manage/newuser','UserManageController@newuser');
    Route::get('/user-manage/updateuser/{id}','UserManageController@updateuser');
    Route::post('/user-manage/updateuser/{id}','UserManageController@updateuser');
    Route::get('/user-manage/deleteuser/{id}','UserManageController@deleteuser');
    Route::post('/user-manage/deleteuser/{id}','UserManageController@deleteuser');
    

//    password change start
    Route::get('/user-manage/changepass','UserManageController@changepassword');
    Route::post('/user-manage/changepass','UserManageController@changepassword');

    /*admin profile section*/
    Route::get('/user-manage/profile','UserManageController@profile');
    Route::post('/user-manage/profile','UserManageController@profile');
});