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

Route::get('/', function () {
    return view('home');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// ショップルート
Route::resource('shops', 'User\ShopController');  
    
// オーナー用ショップ一覧
Route::resource('lists', 'User\ListController');

// 商品用
Route::resource('product', 'User\ProductController');

// 商品を購入したときに在庫を一つ減らす
Route::post('product/{product}', 'User\ProductController@BuyButton');

// 商品登録用
Route::post('products/{shop}/makes', 'User\MakeProductController@store');

// CSV出力用
Route::get('download/{value}', 'User\CsvController@download')->name('download.index');
Route::post('download/{value}', 'User\CsvController@download')->name('download.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

