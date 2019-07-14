@extends('layouts.app-admin')

@section('content')
    <table class='table'>
        <tr>
            <th>ステータス</th>
            <th>投稿者</th>
            <th>タイトル</th>
            <th>コメント</th>
            <th>コメント投稿日</th>
            <th></th>
            <th></th>
        </tr>
    @foreach ($comments as $comment)
        <tr>
            @if($comment->approval_flg)
            <td><span class='tag is-primary'>承認済み</span></td>
            @else
            <td><span class='tag'>未承認</span></td>
            @endif
            <td>{{ $comment->contributor }}</td>
            <td><a href="{{ route('article.show', ['id' => $comment->article["id"]]) }}">{{ $comment->article["title"] }}</a></td>
            <td>{!! nl2br(e($comment->text)) !!}</td>
            <td>{{ $comment->created_at }}</td>
            @if($comment->approval_flg)
            <form action="{{ route('comment.back_approval_pending', ['id' =>  $comment->id]) }}" method='post' id="comment-form">
            @csrf
            <td><button class='button'>承認待ちへ戻す</button></td>
            </form>
            @else
            <form action="{{ route('comment.approve', ['id' => $comment->id]) }}" method='post' id="comment-form">
            @csrf
            <td><button class='button is-primary'>承認する</button></td>
            </form>
            @endif
            <form action="{{ route('comment.delete', ['id' => $comment->id]) }}" method='post' id="comment-form">
                @csrf
                <td><button class='button is-danger'>削除する</button></td>
            </form>
        </tr>
    @endforeach
    </table>
    {{ $comments->links() }}
@endsection
