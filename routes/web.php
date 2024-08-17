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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login'); //ログイン画面の表示
Route::post('/login', 'Auth\LoginController@login'); //ログイン処理を行うURL

Route::get('/register', 'Auth\RegisterController@register'); //新規登録の画面表示用
Route::post('/register', 'Auth\RegisterController@register'); //情報を登録処理する

Route::get('/added', 'Auth\RegisterController@added');
//Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
// Route::get('/top','PostsController@index');
//上記だとエラーが出たのでpostに変更
//ミドルウェアグループ追記　コメントアウト外してしまうとルーティングが機能しなくなる
// Route::group(['middleware' => 'auth'], function(){

Route::get('/top','PostsController@index');

Route::get('/profile','UsersController@profile');

Route::get('/search','UsersController@index'); //検索画面表示兼検索機能

Route::get('/follow-list','PostsController@index');

Route::get('/follower-list','PostsController@index');

// });
