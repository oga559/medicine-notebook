<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ユーザー画面</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
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
                    <div class="box_title"><h3>服用時間が過ぎています！</h3></div>
                    <p>お薬名：{{ $dosing->drug_name }}</p>
                    <p>服用時間：{{ Str::limit($dosing->dosing_time,16,'') }}</p>
                    <input type="hidden" value="{{ $dosing->id }}" name="id">
                    <label>メモ:</label>
                    <div>
                        <textarea cols="50" rows="5" readonly>{{ $dosing->note }}</textarea>
                    </div>
                    <input type="hidden" value="0" name="dosing_flag">
                    <input type="submit" value="お薬飲みました">
                </form>
            </div>
        @endforeach
        <hr>
        <h2>服用予約一覧</h2>
        <hr>
        @foreach ($still as $dosing)
            <div class="appointment">
                <form action="{{ route('delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <label>服用時間はまだです</label>
                    <p>お薬名：{{ $dosing->drug_name }}</p>
                    <p>服用時間：{{ Str::limit($dosing->dosing_time,16,'') }}</p>
                    <input type="hidden" value="{{ $dosing->id }}" name="id">
                    <label>メモ:</label>
                    <div>
                        <textarea cols="50" rows="5" readonly>{{ $dosing->note }}</textarea>
                    </div>
                    <input type="submit" value="服用予約を削除します">
                </form>
            </div>
            <hr>
        @endforeach
        <h2>服用履歴</h2>
        <hr>
        @foreach ($history as $histories)
            <div class="history">
                <form action="{{ route('delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <p>お薬名：{{ $histories->drug_name }}</p>
                    <p>服用時間：{{ Str::limit($histories->dosing_time,16,'') }}</p>
                    <input type="hidden" value="{{ $histories->id }}" name="id">
                    <label>メモ:</label>
                    <div>
                        <textarea cols="50" rows="5" readonly>{{ $histories->note }}</textarea>
                    </div>
                    <input type="submit" value="履歴を削除します">
                </form>
            </div>
            <hr>
        @endforeach
</body>
</html>