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
Route::group(['prefix'=>'/','namespace'=>'FrontSite','middleware'=>'guest'], function(){
    
    Route::get('/{locale?}', 'HomeController@welcome')->where(['locale'=>'(en|nep)']);
    /*Athentication start*/
    Route::get('/login/{locale?}', 'Auth\LoginController@showLoginForm');
    Route::post('/login/{locale?}', 'Auth\LoginController@login');
    
    Route::get('/register/{locale?}', 'Auth\RegisterController@showRegistrationForm');
    Route::post('/register/{locale?}', 'Auth\RegisterController@register');
    /*Athentication end*/
    
    Route::get('/home/{locale?}', 'HomeController@index')->name('home');
    Route::get('/home/{locale?}', 'HomeController@index')->name('home');
    
    Route::post('/set-lang/{locale}', 'HomeController@setLanguage');    
    
    Route::get('/file-source/{imagage_name}','HomeController@ImageDisplay');

});
Route::group(['prefix'=>'/','namespace'=>'FrontSite','middleware'=>'web'], function(){

    Route::get('/home/{locale?}', 'HomeController@index')->name('home');
    Route::post('/subscription/{locale?}', 'HomeController@subscription');
    Route::post('/set-lang/{locale}/{prevPath}', 'HomeController@setLanguage');
    
    
    /*Athentication start*/
    Route::post('/logout/{locale?}', 'Auth\LoginController@logout');
    /*Athentication end*/
});

