@extends('layouts.app')

@section('content')

    @foreach ($articles as $article)
    <div class="tile is-child box">
        <h2 class='title'><a href='{{ route("article.show", ["article" => $article]) }}'>{{ $article->title }}</a></h2>
        <span class='tag is-info post-date-time'>{{ $article->post_date_time }}</span>
        <div class="article-text content">
            {!! $article->text !!}
        </div>
        <a class="button" href='{{ route("article.show", ["article" => $article]) }}'>
            <span class="icon is-large has-text-info">
                <i class="mdi mdi-comment-outline mdi-24px"></i>
            </span>
            <span>{!! $article->comments->where('approval_flg', true)->count() !!}</span>
        </a>
    </div>
    @endforeach
    <div class="tile is-child">
        @if(count($articles) > 0)
        {{ $articles->links() }}
        @endif
    </div>

@endsection
