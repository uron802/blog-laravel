@extends('layouts.app')

@section('content')

    @foreach ($articles as $article)
    <div class="article-title level">
        <h2 class='title level-left'><a href='{{ route("article.show", ["id" => $article->id]) }}'>{{ $article->title }}</a></h2>
        <span class='level-right tag is-info'>{{ $article->post_date_time }}</span>
    </div>
    <div class="article-text">
        {!! $article->text !!}
    </div>
    @endforeach
    @if(count($articles) > 0)
    {{ $articles->links() }}
    @endif

@endsection
