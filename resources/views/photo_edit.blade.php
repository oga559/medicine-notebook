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
    <form action="{{ route('photo_update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" value="{{ Auth::id() }}" name="user_id">
        <input type="hidden" name="id" value="{{ $photo->id }}">
        <div>
            <input type="file" name="photo">
        </div>
        <div class="error">
            @if($errors->has("photo")) 
                {{ $errors->first("photo") }} 
            @endif 
        </div>
        <div>
            <input type="date" name="prescription_date" value="{{ old('prescription_date',Str::limit($photo->prescription_date,10,'')) }}" >
        </div>
        <div class="error">
            @if($errors->has("prescription_date")) 
                {{ $errors->first("prescription_date") }} 
            @endif 
        </div>
        <div>
            <input type="text" name="medical_subjects" placeholder="診療科目を指定して下さい" value="{{ old('medical_subjects',$photo->medical_subjects) }}">
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
                {{-- 登録画面で登録していたか判断し、登録していたらoptionを保持して選択済みにする --}}
                @if ($photo->medical_factories_id === $factory_selects->id)
                    <option value="{{ $photo->medical_factories_id }}" selected>{{ $factory_selects->factory_name }}</option>
                @else
                    <option value="{{ $factory_selects->id,old('medical_factories_id') }}">{{ $factory_selects->factory_name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div>
            <textarea name="note" cols="30" rows="10" placeholder="メモ" value="{{ old('note') }}">@if(old('note') == ''){{$photo->note}}@else{{ old('note') }}@endif</textarea>
        </div>
        <div class="error">
            @if($errors->has("note")) 
                {{ $errors->first("note") }} 
            @endif 
        </div>
        <div>
            <input type="submit" value="編集した内容を登録">
        </div>
    </form> 
    <form action="{{ route('photo_delete') }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" value="{{ $photo->id }}">
        <input type="submit" value="削除します">
    </form>
</body>
</html>