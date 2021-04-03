<!DOCTYPE html>
<html lang="ja">
<head>
    <title>ユーザーページ</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ユーザーページ</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
</head>
<body>
    @include('header')
    <main class="py-4">
            <a href="{{ route('post.create') }}">お薬登録</a>
            <a href="{{ route('photo.create') }}">画像登録</a>
            <a href="{{ route('dosing.create') }}">服用時間登録</a>
            <a href="{{ route('show') }}">お薬手帳</a>
            @foreach ($expired as $dosing)
                <div class="alert">
                    <form action="{{ route('flag_update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <span>まだお薬を飲んでいません</span>
                        <p>お薬名：{{ $dosing->drug_name }}</p>
                        <p>服用時間：{{ Str::limit($dosing->dosing_time,16,'') }}</p>
                        <input type="hidden" value="{{ $dosing->id }}" name="id">
                        <input type="hidden" value="0" name="dosing_flag">
                        <input type="submit" value="お薬飲みました">
                    </form>
                </div>
                <hr>
            @endforeach
            <h2>服用予約一覧</h2>
            <hr>
            @foreach ($still as $dosing)
                <div>
                    <form action="{{ route('delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <span>服用時間はまだです</span>
                        <p>お薬名：{{ $dosing->drug_name }}</p>
                        <p>服用時間：{{ Str::limit($dosing->dosing_time,16,'') }}</p>
                        <input type="hidden" value="{{ $dosing->id }}" name="id">
                        <input type="submit" value="登録を削除します">
                    </form>
                </div>
                <hr>
            @endforeach
    </main>
</body>
</html>