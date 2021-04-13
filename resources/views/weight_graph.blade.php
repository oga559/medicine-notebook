<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>グラフ</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
	<script src="{{ asset('js/app.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/weight.css') }}" rel="stylesheet">
</head>
<body>
    @include('header')
    <main>
        <form action="{{ route('graph.store') }}" method="POST">
            @csrf 
            <input type="hidden" value="{{ Auth::id() }}" name="user_id">
            <h2>体重を管理しよう！！</h2>
            <label>体重(少数点3桁で切り上げされます)</label>
            <div>
                <input type="text" name="weight" value="{{ old('weight') }}">
                <span class="weight_kg">Kg</span>
            </div>
            <div class="error">
                @if($errors->has("weight")) 
                    {{ $errors->first("weight") }} 
                @endif 
            </div>
            <label>計測日</label>
            <div>
                <input type="date" name="date_key" value="{{ old('date_key') }}">
            </div>
            <div class="error">
                @if($errors->has("date_key")) 
                    {{ $errors->first("date_key") }}
                @endif 
            </div>    
            <input type="submit" value="登録">
        </form>
        <h2>体重管理グラフ</h2>
        <div class="wrap-chart">
            <div class="chart-container" style="position: relative; width:80vw; height:80vh;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </main>
    <script id="script" src="{{ asset('js/weight.js') }}" type="text/javascript" data-param='<?php echo json_encode([$label,$weight_log]);?>'></script>
</body>
</html>