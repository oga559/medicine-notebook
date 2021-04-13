<!DOCTYPE html>
<html lang="ja">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/photo_edit.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/post.css') }}" rel="stylesheet">
    <title>更新ページ</title>
</head>
<body>
    @include('header')
    <main>
        <h2>編集ページ</h2>
        <form action="{{ route('post_update') }}" method="POST">
            @csrf 
            @method('PUT')
            <input type="hidden" name="id" value="{{ $post->id }}">
            <label>お薬名<span>※必須項目です</span></label>
            <div>
                <input type="text" name="drug_name" placeholder="お薬名を指定して下さい" value="{{ old('drug_name',$post->drug_name) }}">
            </div>
            <div class="error">
                @if($errors->has("drug_name")) 
                    {{ $errors->first("drug_name") }} 
                @endif 
            </div>
            <label>服用時間(時間まで入力してください)<span>※必須項目です</span></label>
            <div>
                <input type="date" name="prescription_date" value="{{ old('prescription_date',Str::limit($post->prescription_date,10,'')) }}">
            </div>
            <div class="error">
                @if($errors->has("prescription_date")) 
                    {{ $errors->first("prescription_date") }} 
                @endif 
            </div>
            <label>診療科目(眼科や内科など)</label>
            <div>
                <input type="text" name="medical_subjects" placeholder="診療科目を指定して下さい" value="{{ old('medical_subjects',$post->medical_subjects) }}">
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
                        {{-- 薬登録で登録していた場合の登録していたoptionを選択済みにする --}}
                        @if ($post->medical_factory_id === $factory_selects->id)
                            <option value="{{ $post->medical_factory_id }}" selected>{{ $factory_selects->factory_name }}</option>
                        @else
                        <option value="{{ $factory_selects->id,old('medical_factory_id') }}">{{ $factory_selects->factory_name }}</option>
                        @endif
                        @endforeach
                </select>
            </div>
            <div>
                <textarea name="note" cols="30" rows="10" placeholder="メモ">@if(old('note') == ''){{$post->note}}@else{{ old('note') }}@endif</textarea>
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
        <form action="{{ route('post_delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $post->id }}">
            <input type="submit" value="削除します">
        </form>
    </main>
</body>
</html>