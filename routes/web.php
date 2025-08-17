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
//ログイン画面の表示
Route::get('/login', 'Auth\LoginController@login')->name('login');
//ログイン処理を行うURL
Route::post('/login', 'Auth\LoginController@login');

//新規登録の画面表示用
Route::get('/register', 'Auth\RegisterController@register');
//情報を登録処理する
Route::post('/register', 'Auth\RegisterController@register');
Route::get('/added', 'Auth\RegisterController@added');
// Route::post('/added', 'Auth\RegisterController@added');


// Route::get('/login', function () {
  //       return view('auth.login');
  // });  //ヘッダーログアウト機能(authのlogin.blade.php(viwe)を呼び出しますよ。というルート)

  //ログイン中のページ
  Route::group(['middleware' => 'auth'],function(){
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    //ホーム画面表示
    Route::get('/top','PostsController@index');
    //ユーザープロフィール画面表示
    Route::get('/profile','UsersController@profile');
    //検索画面表示兼検索機能
    Route::get('/search','UsersController@search');
    //フォローリスト画面表示
    Route::get('/follow-list','FollowsController@followList');
    //フォロワーリスト画面表示
    Route::get('/follower-list','FollowsController@followerList');

    //投稿フォーム
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');


  });
