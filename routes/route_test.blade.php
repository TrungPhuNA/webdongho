<?php

    Route::group(['prefix' => 'demo'],function(){
        Route::get('/','TestController@index');
    });
?>