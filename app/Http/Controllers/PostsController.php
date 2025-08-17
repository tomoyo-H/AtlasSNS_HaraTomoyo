<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index(){
        return view('posts.index');
    }


      // 投稿フォーム表示
      public function create()
      {
          return view('posts.create');
      }

      // 投稿を保存
      public function store(Request $request)
      {
          // バリデーション
          $request->validate([
              'content' => 'required|max:150',
          ]);

          // 保存処理
          $post = new Post();
          $post->content = $request->content;
          $post->save();

          return redirect()->route('posts.create')->with('success', '投稿しました！');
        }
}
