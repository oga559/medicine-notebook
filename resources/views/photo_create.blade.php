<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src='/js/photo_create.js'></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/create.css') }}" rel="stylesheet">
    <title>画像投稿ページ</title>
</head>
</head>
<body>
    @include('header')
    <h2>画像登録</h2>
    <form action="{{ route('photo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <img id="img">
        <input type="hidden" value="{{ Auth::id() }}" name="user_id">
        <label>画像<span>※必須項目です</span></label>
        <div>
            <input id="profile_image" type="file" name="photo" onchange="previewImage(this);">
        </div>
        <div class="error">
            @if($errors->has("photo")) 
                {{ $errors->first("photo") }} 
            @endif 
        </div>
        <label>服用時間(時間まで入力してください)<span>※必須項目です</span></label>
        <div>
            <input type="date" name="prescription_date" value="{{ old('prescription_date') }}">
        </div>
        <div class="error">
            @if($errors->has("prescription_date")) 
                {{ $errors->first("prescription_date") }} 
            @endif 
        </div>
        <label>診療科目(眼科や内科など)</label>
        <div>
            <input class="date" type="text" name="medical_subjects" placeholder="診療科目を指定して下さい" value="{{ old('medical_subjects') }}">
        </div>
        <div class="error">
            @if($errors->has("medical_subjects")) 
                {{ $errors->first("medical_subjects") }} 
            @endif 
        </div>
        <label>医療施設名</label>
        <div>
            <select name="medical_factory_id" class="select">
                <option value="0">医療施設を選択してください</option>
                    @foreach($factory_select as $factory_selects)
                        <option value="{{ $factory_selects->id }}" @if(old('medical_factory_id') == $factory_selects->id) selected  @endif>{{ $factory_selects->factory_name }}</option>
                    @endforeach
            </select>
        </div>
        <label>メモ</label>
        <div>
            <textarea name="note" cols="30" rows="10" placeholder="メモ">{{ old('note') }}</textarea>
        </div>
        <div class="error">
            @if($errors->has("note")) 
                {{ $errors->first("note") }} 
            @endif 
        </div>
        <div>
            <input type="submit" value="お薬登録">
        </div>
    </form>
</body>
</html>