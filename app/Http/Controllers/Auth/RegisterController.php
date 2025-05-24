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
        if($request->isMethod('post')){//postで送ったときに動くif文

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');
            //バリデーション
            $validated = $request->validate([
                'username' => 'required|min:2|max:12',
                'mail' => 'required|min:5|max:40|unique:users,mail|email',
                'password' => 'required|confirmed|Rules\Password::defaults()',
            ]);

            //新規登録の機能
            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

            return redirect('/added');
        }
        return view('auth.register');
    }

    //登録後の名前表示機能
    public function added(Request $request){
        $username = $request->input('username');
        return view('auth.added', ['username'=>$username]);
    }

}
