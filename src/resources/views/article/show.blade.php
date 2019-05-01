@extends('layouts.app')

@section('content')

<div class="tile is-child box">
    <h2 class='title'>{{ $article->title }}</h2>
    <span class='tag is-info post-date-time'>{{ $article->post_date_time }}</span>
    <div class="article-text content">
        {!! $article->text !!}
    </div>
</div>

@endsection
