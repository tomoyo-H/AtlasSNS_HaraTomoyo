<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request){
        if($request->isMethod('post')){

            //バリデーション追加
            $request->validate([
                'username' => 'required|between:2,12',
                'mail' => 'required|email:filter|unique:users,mail|between:5,40',
                'password' => 'required|alpha_num'
            ]);

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            //新規登録の機能追加
            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

            return redirect('/added');
        }
        return view('auth.register');
    }

    //登録後の名前表示機能追加
    public function added(Request $request){
        $username = $request->input('username');
        return view('auth.added', ['username'=>$username]);
    }
}
