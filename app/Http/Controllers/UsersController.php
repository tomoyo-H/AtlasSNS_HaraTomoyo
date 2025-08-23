<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    //ユーザープロフィール表示機能
    public function profile(){
        return view('users.profile');
    }

    //ユーザープロフィール編集機能
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // 更新処理
    public function update(Request $request)
    {
        $user = Auth::user();

        //ユーザープロフィール編集バリデーション
        $request->validate([
            'username' => 'required|min:2|max:12',
            'mail' => 'required|min:5|max:40|unique:users,mail|email',
            'password' => 'required|alpha_num|min:8|max:20|confirmed',
            'password_confirmation' => 'required|alpha_num|min:8|max20',
            'bio' => 'nullable|string|max:150',
            'images' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        $user = Auth::user();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->bio = $request->bio;

         if ($request->filled('password')) {
              $user->password = bcrypt($request->password);
              }

         if ($request->hasFile('avatar')) {
            $filename = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('avatars'), $filename);
            $user->avatar = 'avatars/' . $filename;
            }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'プロフィールを更新しました！');
    }


    //ユーザー検索機能
    public function search(Request $request){
        $keyword = $request->input('keyword');

        // キーワードがあれば検索
        $query = User::query();
        if (!empty($keyword)) {
        $query->where('name', 'LIKE', "%{$keyword}%")
        ->orWhere('email', 'LIKE', "%{$keyword}%");
        }

        $users = $query->paginate(10); // ページネーション付き
        return view('users.search', compact('users', 'keyword'));
        }

}
