<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/top'; //homeからtopへ変更

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        if($request->isMethod('post')){

            $data=$request->only('mail','password');
            // ログインが成功したら、トップページへ
            //↓ログイン条件は公開時には消すこと
            if(Auth::attempt($data)){
                return redirect('/top');
            }
        }
        return view("auth.login"); //ファイル名
    }

    //フォロー、フォロワー数の取得
    public function count($id){
        $user = User::findOrFail($id);
        $followingsCount = $user->followings()->count(); // フォロー数
        $followersCount = $user->followers()->count();   // フォロワー数
        return view("auth.login", compact('user', 'followingsCount', 'followersCount'));
    }


    //ログアウト機能用のメソッド
    public function logout(Request $request){
        Auth::logout();
        return redirect('/login'); //URL名
    }
}
