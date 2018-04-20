<?php

Route::group(['prefix'=>'/','namespace'=>'Api_token\Controllers','middleware'=>'guest'], function(){
    Route::post('/get-api-token','TokenController@index');
    
});