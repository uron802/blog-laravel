@extends('layouts.app')

@section('content')

<div class="tile is-child box">
    <h1 class='title'>{{ $article->title }}</h1>
    <h2 class='subtitle'><span>@</span>{{ $article->author->name }} {{ $article->post_date_time }}</h2>
    <div class="field is-grouped is-grouped-multiline">
        @forelse ($tags as $tag)
        <div class="control">
            <div class="tags has-addons">
                <a class="tag is-link">{{ $tag->name }}</a>
            </div>
        </div>
        @empty
        @endforelse
    </div>
    <div class="article-text content">
        {!! $article->text !!}
        <a class="button ajax_plus_like_num" href='#' data-article-id='{{ route('article.plusLikeNum', ['article' => $article]) }}'>
            <span class="icon is-large has-text-danger">
                <i class="mdi mdi-heart-outline mdi-24px"></i>
            </span>
            <span class='js-like_num'>{!! $article->like_num !!}</span>
        </a>
    </div>
    <div class="box">
        <form action="{{ route('comment.store', ['article' => $article]) }}" method='post' id="comment-form">
            @csrf
            <article class="media">
                <div class="media-content">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="text" placeholder="投稿者" name="contributor">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                        <textarea class="textarea" placeholder="Add a comment..." name="text"></textarea>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                        <button class="button">投稿する</button>
                        </p>
                    </div>
                </div>
            </article>
        </form>
    </div>
    @foreach($comments as $comment)
        @if ($comment->approval_flg)
            <div class="box">
                <article class="media">
                <div class="media-content">
                    <div class="content">
                    <p>
                    <strong>{!! $comment->contributor !!}</strong> <small>{!! $comment->updated_at !!}</small>
                        <br>
                        {!! nl2br(e($comment->text)) !!}
                    </p>
                    </div>
                </div>
                </article>
            </div>
        @endif
      @endforeach
</div>

@endsection
