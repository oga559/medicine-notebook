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
    <script src="{{ asset('js/photo_edit.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>更新ページ</title>
</head>
<body>
    @include('header')
    <h2>編集ページ</h2>
    <form action="{{ route('post_update') }}" method="POST">
        @csrf 
        @method('PUT')
        <input type="hidden" name="id" value="{{ $post->id }}">
        <div>
            <input type="text" name="drug_name" placeholder="お薬名を指定して下さい" value="{{ old('drug_name',$post->drug_name) }}">
        </div>
        <div class="error">
            @if($errors->has("drug_name")) 
                {{ $errors->first("drug_name") }} 
            @endif 
        </div>
        <div>
            <input type="date" name="prescription_date" value="{{ old('prescription_date',Str::limit($post->prescription_date,10,'')) }}">
        </div>
        <div class="error">
            @if($errors->has("prescription_date")) 
                {{ $errors->first("prescription_date") }} 
            @endif 
        </div>
        <div>
            <input type="text" name="medical_subjects" placeholder="診療科目を指定して下さい" value="{{ old('medical_subjects',$post->medical_subjects) }}">
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
</body>
</html>