@extends('layouts.login')

@section('content')

<div class="container">

    <!--  検索フォーム -->
    <form action="{{ route('users.search') }}" method="GET">
        <input type="text" name="keyword" value="{{ old('keyword', $keyword) }}" placeholder="ユーザー名" style="width: 300px; height: 40px;">
        <button type="submit">
        <image src="{{ asset('images/search.png') }}" style="width: 40px; height: 40px;">
        </button>
    </form>

    <hr>

    <!-- 検索結果  -->
    @if($users->count())
        <ul>
            @foreach($users as $user)
                <li>
                    {{ $user->name }}（{{ $user->email }}）
                </li>
            @endforeach
        </ul>

        {{ $users->links() }} <!-- ページネーション -->
            @else
        <p>ユーザーが見つかりませんでした。</p>
    @endif
</div>




@endsection
