@extends('layouts.login')

@section('content')

<div class="container">

        {{ Form::open(['url' => '/posts']) }}
        <div class="form-group">
          <!--ユーザーアイコン-->
            <img src="{{ asset('images/icon1.png') }}" style="width: 40px; height: 40px;">
             <button type="submit" class="btn btn-success pull-right">
               <!--投稿フォーム-->
               <form action="{{ route('posts.store') }}" method="POST">
                 @csrf
                   <textarea name="content" rows="4" cols="40" placeholder="投稿内容を入力してください。"
                   style="border:none; outline:none; resize:none; width:100%; height:80px;">{{ old('content') ? old('content') : '' }}</textarea>
               </form>
            </button>
          <!--投稿ボタン-->
          <button type="submit" style="border:none; background:none; cursor:pointer;">
             <image src="{{ asset('images/post.png') }}" style="width: 40px; height: 40px;">
           </button>
        </div>
        {{ Form::close() }}

    </div>

@endsection
