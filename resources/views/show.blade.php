<!DOCTYPE html>
<html lang="ja">
<head>
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
</head>
    <title>お薬登録ページ</title>
</head>
    @include('header')
{{-- 
@foreach ($user_photo as $photo)
@foreach ($user_posts as $posts)
    
@if ($now->gte($photo->prescription_date)or($now->gte($posts->prescription_date)))
@isset($photo)
<div>
    <img src="../../uploads/{{ $photo->photo }}" width="200px" height="200px">
</div>
@endisset
    <p>{{ $posts->drug_name }}</p>            
@else

@endif
@endforeach
@endforeach --}}