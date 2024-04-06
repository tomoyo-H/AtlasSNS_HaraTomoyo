@extends('layouts.logout')

@section('content')

<div id="clear">
  <p>{{$username}}さん</p><!-- 新規登録後名前表示機能 -->
  <p>ようこそ！AtlasSNSへ！</p>
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう。</p>

  <p class="btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection
