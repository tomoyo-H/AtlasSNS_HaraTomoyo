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


// Route::get('/login', function () {
  //       return view('auth.login');
  // });  //ヘッダーログアウト機能(authのlogin.blade.php(viwe)を呼び出しますよ。というルート)

  Route::group(['middleware' => 'auth'],function(){
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    //ログイン中のページ
    Route::get('/top','PostsController@index'); //ホーム画面表示

    Route::get('/profile','UsersController@profile'); //ユーザープロフィール画面表示

    Route::get('/search','UsersController@search'); //検索画面表示兼検索機能

    Route::get('/follow-list','FollowsController@followList'); //フォローリスト画面表示

    Route::get('/follower-list','FollowsController@followerList'); //フォロワーリスト画面表示
  });
