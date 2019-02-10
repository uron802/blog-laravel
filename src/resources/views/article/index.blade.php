@extends('layouts.app')

@section('content')

    @foreach ($articles as $article)
    <div class="article-title">
        <h2><a href='{{ route("article.show", ["id" => $article->id]) }}'>{{ $article->title }}</a></h2>
        <span>投稿時間：{{ $article->post_date_time }}</span>
    </div>
    <div class="article-text">
        {!! $article->text !!}
    </div>
    @endforeach
    @if(count($articles) > 0)
    {{ $articles->links() }}
    @endif

@endsection
