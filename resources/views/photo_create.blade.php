<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>画像登録</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src='/js/photo_create.js'></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
    <title>画像投稿ページ</title>
</head>
<body>
    @include('header')
    <form action="{{ route('photo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <img id="img">
        <input type="hidden" value="{{ Auth::id() }}" name="user_id">
        <div>
            <input id="profile_image" type="file" name="photo" onchange="previewImage(this);">
        </div>
        <div class="error">
            @if($errors->has("photo")) 
                {{ $errors->first("photo") }} 
            @endif 
        </div>
        <div>
            <input type="date" name="prescription_date" value="{{ old('prescription_date') }}">
        </div>
        <div class="error">
            @if($errors->has("prescription_date")) 
                {{ $errors->first("prescription_date") }} 
            @endif 
        </div>
        <div>
            <input type="text" name="medical_subjects" placeholder="診療科目を指定して下さい" value="{{ old('medical_subjects') }}">
        </div>
        <div class="error">
            @if($errors->has("medical_subjects")) 
                {{ $errors->first("medical_subjects") }} 
            @endif 
        </div>
        <div>
            <select name="medical_factory_id">
                <option value="0">医療施設を選択してください</option>
                    @foreach($factory_select as $factory_selects)
                        <option value="{{ $factory_selects->id }}" @if(old('medical_factory_id') == $factory_selects->id) selected  @endif>{{ $factory_selects->factory_name }}</option>
                    @endforeach
            </select>
        </div>
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