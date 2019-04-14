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

Auth::routes();

Route::group(['namespace' => 'Auth'],function(){
	Route::get('dang-ky','RegisterController@getRegister')->name('get.register');
	Route::post('dang-ky','RegisterController@postRegister')->name('post.register');
	
	Route::get('dang-nhap','LoginController@getLogin')->name('get.login');
	Route::post('dang-nhap','LoginController@postLogin')->name('post.login');
	
	Route::get('dang-xuat','LoginController@getLogout')->name('get.logout.user');
});

Route::get('/', 'HomeController@index')->name('home');

Route::get('danh-muc/{slug}-{id}','CategoryController@getListProduct')->name('get.list.product');
Route::get('san-pham/{slug}-{id}','ProductDetailController@productDetail')->name('get.detail.product');


// bai viet
Route::get('bai-viet','ArticleController@getListArticle')->name('get.list.article');
Route::get('bai-viet/{slug}-{id}','ArticleController@getDetailArticle')->name('get.detail.article');

Route::prefix('shopping')->group(function () {
	Route::get('/add/{id}','ShoppingCartController@addProduct')->name('add.shopping.cart');
	Route::get('/delete/{id}','ShoppingCartController@deleteProductItem')->name('delete.shopping.cart');
	Route::get('/danh-sach','ShoppingCartController@getListShoppingCart')->name('get.list.shopping.cart');
});

Route::group(['prefix' => 'gio-hang','middleware' => 'CheckLoginUser'],function(){
	Route::get('/thanh-toan','ShoppingCartController@getFormPay')->name('get.form.pay');
	Route::post('/thanh-toan','ShoppingCartController@saveInfoShoppingCart');
});

Route::group(['prefix' => 'ajax','middleware' => 'CheckLoginUser'],function(){
	Route::post('/danh-gia/{id}','RatingController@saveRating')->name('post.rating.product');
});

Route::group(['prefix' => 'ajax'],function(){
	Route::post('/view-product','HomeController@renderProductView')->name('post.product.view');
});


Route::get('ve-chung-toi','PageStaticController@aboutUs')->name('get.about_us');
Route::get('lien-he','ContactController@getContact')->name('get.contact');
Route::post('lien-he','ContactController@saveContact');

Route::group(['prefix' => 'user','middleware' => 'CheckLoginUser'],function(){
	Route::get('/','UserController@index')->name('user.dashboard');
	
	Route::get('/info','UserController@updateInfo')->name('user.update.info');
	Route::post('/info','UserController@saveUpdateInfo');
});

include 'route_test.blade.php';