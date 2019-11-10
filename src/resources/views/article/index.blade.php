@extends('layouts.app')

@section('content')
    @isset ($tag)
    <div class="box">
        <nav class="breadcrumb" aria-label="breadcrumbs">
            <ul>
                <li><a href="{{ route("article") }}">トップ</a></li>
                <li class="is-active"><a href="#" aria-current="page">{{ $tag->name }}</a></li>
            </ul>
        </nav>
    </div>
    @endisset
    @foreach ($articles as $article)
    <div class="tile is-child box">
        <h2 class='title'><a href='{{ route("article.show", ["article" => $article]) }}'>{{ $article->title }}</a></h2>
        <span class='tag is-info post-date-time'>{{ $article->post_date_time }}</span>
        <div class="field is-grouped is-grouped-multiline">
            @forelse ($article->tags as $tag)
            <div class="control">
                <div class="tags has-addons">
                    <a class="tag is-link" href='{{ route("article") . "?tag=" . $tag->id }}'>{{ $tag->name }}</a>
                </div>
            </div>
            @empty
            @endforelse
        </div>
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
