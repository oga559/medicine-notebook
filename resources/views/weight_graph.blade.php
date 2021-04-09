<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>グラフ</title>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
	<script src="{{ asset('js/app.js') }}"></script>	
</head>
<body>
    @include('header')
    <form action="{{ route('post_weight') }}" method="POST">
        @csrf 
        <input type="hidden" value="{{ Auth::id() }}" name="user_id">
        <h2>体重を管理しよう</h2>
		<p>体重</p>
        <input type="text" name="weight" value="{{ old('weight') }}">
		<div class="error">
            @if($errors->has("weight")) 
                {{ $errors->first("weight") }} 
            @endif 
        <p>時間</p>
        <input type="date" name="date_key" value="{{ old('date_key') }}">
		<div class="error">
            @if($errors->has("date_key")) 
                {{ $errors->first("date_key") }}
            @endif 
        <input type="submit">
    </form>
	<h1>グラフ</h1>
	<canvas id="myChart"></canvas>
	<script id="script" src="{{ asset('js/weight.js') }}" type="text/javascript" data-param='<?php echo json_encode([$label,$weight_log]);?>'></script>
</body>
</html>