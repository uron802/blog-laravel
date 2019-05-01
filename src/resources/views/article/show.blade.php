@extends('layouts.app')

@section('content')

<div class="article-title level">
    <h2 class='title level-left'>{{ $article->title }}</h2>
    <span class='level-right tag is-info'>{{ $article->post_date_time }}</span>
</div>
<div class="article-text">{!! $article->text !!}</div>

@endsection
