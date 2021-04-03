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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>お薬登録ページ</title>
</head>
<body>
    @include('header')
    <div>
        <h2>お薬投稿</h2>
        @foreach($post as $posts)         
        <h4>お薬名：{{ $posts->drug_name }}</h4>
        <p>処方日：{{ Str::limit($posts->prescription_date,10,'') }}</p>
        {{-- 診療科目を登録しているか判断する --}}
        @if($posts->medical_subjects)
            <p>診療科目：{{ $posts->medical_subjects }}</p>
        @else
            <p>診療科目：診療科目が登録されていません</p> 
        @endif
        <a href="{{ route('post_edit',$posts->id) }}">編集ページ</a>
        <hr>
        @endforeach
    </div>
    <hr>
    <div>
        <h2>画像登録</h2>
        @foreach($photo as $photos)
        <span>お薬画像：</span><img src="storage/images/{{ $photos->photo }}" width="200px" height="100px">
            <p>処方日：{{ Str::limit($photos->prescription_date,10,'') }}</p>
            @if($photos->medical_subjects)
                <p>診療科目：{{ $photos->medical_subjects }}</p>
            @else
                <p>診療科目：診療科目が登録されていません</p> 
            @endif
            <a href="{{ route('photo_edit',$photos->id) }}">編集ページ</a>
            <hr>
        @endforeach    
    </div>
</body>