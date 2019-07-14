@extends('layouts.app')

@section('content')

<div class="tile is-child box">
    <h2 class='title'>{{ $article->title }}</h2>
    <span class='tag is-info post-date-time'>{{ $article->post_date_time }}</span>
    <div class="article-text content">
        {!! $article->text !!}
    </div>
    <div class="box">
        <form action="{{ route('comment.store', ['id' => $article->id]) }}" method='post' id="comment-form">
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
