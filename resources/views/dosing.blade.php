<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>服用時間登録ページ</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('header')
    <form action="{{ route('dosing.store') }}" method="POST">
        @csrf 
        <input type="hidden" value="{{ Auth::id() }}" name="user_id">
        <input type="hidden" value="1" name="dosing_flag">
        <div>
            <input type="text" name="drug_name" placeholder="お薬名を入力して下さい">
        </div>
        <div class="error">
            @if($errors->has("drug_name")) 
                {{ $errors->first("drug_name") }} 
            @endif 
        </div>
        <div>
            <input type="datetime-local" name='dosing_time'>
        </div>
        <div class="error">
            @if($errors->has("dosing_time")) 
                {{ $errors->first("dosing_time") }} 
            @endif 
        </div>
        <div>
            <textarea name="note" cols="30" rows="10" placeholder="メモ"></textarea>
        </div>
        <div class="error">
            @if($errors->has("note")) 
                {{ $errors->first("note") }} 
            @endif 
        </div>
        <div>
            <select name="bulk_post">
            <option value="0">まとめて登録</option>
            <option value="1">１週間分</option>
        </select>
        </div>
        <div>
            <input type="submit" value="お薬登録">
        </div>
    </form>
</body>
</html>