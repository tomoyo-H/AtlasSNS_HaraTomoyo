<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
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
