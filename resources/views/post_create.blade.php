<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>お薬登録ページ</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
    <title>お薬登録ページ</title>
</head>
<body>
    @include('header')
    <form action="{{ route('post.store') }}" method="POST">
        @csrf 
        <input type="hidden" value="{{ Auth::id() }}" name="user_id">
        <div>
            <input type="text" name="drug_name" placeholder="お薬名を指定して下さい" value="{{ old('drug_name') }}">
        </div>
        <div class="error">
            @if($errors->has("drug_name")) 
                {{ $errors->first("drug_name") }} 
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
            <select name="medical_factories_id">
                <option value="0">医療施設を選択してください</option>
                    @foreach($factory_select as $factory_selects)
                        <option value="{{ $factory_selects->id }}" @if(old('medical_factories_id') == $factory_selects->id) selected  @endif>{{ $factory_selects->factory_name }}</option>
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