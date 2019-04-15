<?php

    Route::group(['prefix' => 'demo'],function(){
        Route::get('/','TestController@index');
		Route::get('/danh-muc','TestController@category');
		Route::get('/chi-tiet','TestController@detail')->name('demo.detail');

		Route::get('tin-tuc','TestController@article')->name('get.article');
		Route::get('tin-tuc/chi-tiet','TestController@articleDetail')->name('get.article.detail');
		Route::get('don-hang','TestController@transaction');
    });
?>