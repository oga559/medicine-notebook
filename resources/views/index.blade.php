<!DOCTYPE html>
<html lang="ja">
<head>
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
</head>
<body>
    @include('header')
    @foreach ($expired as $dosing)
        <div class="alert">
            <form action="{{ route('flag_update') }}" method="POST">
                @csrf
                @method('PATCH')
                <h3>まだお薬を飲んでいません</h3>
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
</body>
</html>