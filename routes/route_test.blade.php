<?php

    Route::group(['prefix' => 'demo'],function(){
        Route::get('/','TestController@index');
		Route::get('/danh-muc','TestController@category');
		Route::get('/chi-tiet','TestController@detail')->name('demo.detail');
    });
?>