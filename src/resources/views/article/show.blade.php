@extends('layouts.app')

@section('content')

<div class="article-title">
    <h2>{{ $article->title }}</h2>
    <span>投稿時間：{{ $article->post_date_time }}</span>
</div>
<div class="article-text">{!! $article->text !!}</div>

@endsection
