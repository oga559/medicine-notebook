<!DOCTYPE html>
<html lang="ja">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>お薬履歴ページ</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/show.css') }}">
</head>
<body>
    @include('header')
    <div class="split-box left-box">
        <h2>お薬投稿</h2>
        @foreach($post as $posts)         
        <h4>お薬名：{{ $posts->drug_name }}</h4>
        <label>処方日：{{ Str::limit($posts->prescription_date,10,'') }}</label>
        {{-- 診療科目を登録しているか判断する --}}
        @if($posts->medical_subjects)
            <label>診療科目：{{ $posts->medical_subjects }}</label>
        @else
            <label>診療科目：診療科目が登録されていません</label> 
        @endif
        {{-- 医療施設を選択しているか判断する --}}
        @if ($posts->medical_factory)
            <label>医療施設：{{ $posts->medical_factory->factory_name }}</label>
        @else
            <label>医療施設：登録されていません</label>
        @endif
        <label>メモ</label>
        <div>
            <textarea cols="50" rows="5" readonly>{{ $posts->note }}</textarea>
        </div>
        <a href="{{ route('post_edit',$posts->id) }}">編集ページ</a>
        @endforeach
    </div>
    <div class="split-box right-box">
        <h2>画像登録</h2>
        @foreach($photo as $photos)
        <label>お薬画像：</label>
        <div>
            <img src="storage/images/{{ $photos->photo }}" class="show_img">
        </div>
        <div>
            <label>処方日：{{ Str::limit($photos->prescription_date,10,'') }}</label>
            @if($photos->medical_subjects)
                <label>診療科目：{{ $photos->medical_subjects }}</label>
            @else
                <label>診療科目：診療科目が登録されていません</label> 
            @endif
            {{-- 医療施設を選択しているか判断する --}}
            @if ($photos->medical_factory)
                <label>医療施設：{{ $photos->medical_factory->factory_name }}</label>
            @else
                <label>医療施設：登録されていません</label>
            @endif
            <label>メモ</label>
            <div>
                <textarea cols="50" rows="5" readonly>{{ $photos->note }}</textarea>
            </div>
            <a href="{{ route('photo_edit',$photos->id) }}">編集ページ</a>
        </div>    
        @endforeach
    </div>
</body>
</html>