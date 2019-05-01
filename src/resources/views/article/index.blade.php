@extends('layouts.app')

@section('content')

    @foreach ($articles as $article)
    <div class="tile is-child box">
        <h2 class='title'><a href='{{ route("article.show", ["id" => $article->id]) }}'>{{ $article->title }}</a></h2>
        <span class='tag is-info post-date-time'>{{ $article->post_date_time }}</span>
        <div class="article-text content">
            {!! $article->text !!}
        </div>
        @if(count($articles) > 0)
        {{ $articles->links() }}
        @endif
    </div>
    @endforeach

@endsection
