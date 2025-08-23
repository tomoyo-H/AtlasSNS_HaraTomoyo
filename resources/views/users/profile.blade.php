@extends('layouts.login')

@section('content')

<!--ユーザーアイコン-->
<img src="{{ asset('images/icon1.png') }}" style="width: 40px; height: 40px;">


<body>

    @if (session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>ユーザー名</label>
            <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}">
        </div>

        <div>
            <label>メールアドレス</label>
            <input type="alpha_num" name="mail">
        </div>

        <div>
            <label>パスワード</label>
            <input type="alpha_num" name="password">
        </div>

        <div>
            <label>パスワード確認</label>
            <input type="alpha_num" name="password_confimation">
        </div>

         <div>
            <label>自己紹介文</label>
            <input type="text" name="bio">
        </div>

        <div>
            <label>アイコン画像</label>
            @if (Auth::user()->images)
                <img src="{{ asset(Auth::user()->images) }}"><br>
            @endif
            <input type="file" name="avatar" accept="image/*">
        </div>
        <div>
            <button type="submit">更新</button>
        </div>
    </form>
</body>



@endsection
