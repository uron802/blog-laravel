@extends('layouts.app-admin')

@section('content')
<nav class="breadcrumb" aria-label="breadcrumbs">
    <ul>
        <li class="is-active"><a href="#" aria-current="page">コメント一覧</a></li>
    </ul>
</nav>
<section class='box'>
    <div class="tabs">
        <ul>
            <li id="tab-approval" class="tab is-active"><a>承認済み</a></li>
            <li id="tab-not-approval" class="tab"><a>未承認</a></li>
            <li id="tab-all" class="tab"><a>すべて</a></li>
        </ul>
    </div>
    @foreach ($comments as $comment)
    <div class="tab-page tab-{{ $comment["key"] }} {{ $comment["tab_page_class"] }}">
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
        @foreach ($comment["value"] as $commentValue)
            <tr>
                @if($commentValue->approval_flg)
                <td><span class='tag is-primary'>承認済み</span></td>
                @else
                <td><span class='tag'>未承認</span></td>
                @endif
                <td>{{ $commentValue->contributor }}</td>
                <td><a href="{{ route('article.show', ['article' => $commentValue->article]) }}">{{ $commentValue->article["title"] }}</a></td>
                <td>{!! nl2br(e($commentValue->text)) !!}</td>
                <td>{{ $commentValue->created_at }}</td>
                @if($commentValue->approval_flg)
                <form action="{{ route('comment.back_approval_pending', ['comment' =>  $commentValue]) }}" method='post' id="comment-form">
                @csrf
                <td><button class='button'>承認待ちへ戻す</button></td>
                </form>
                @else
                <form action="{{ route('comment.approve', ['comment' => $commentValue]) }}" method='post' id="comment-form">
                @csrf
                <td><button class='button is-primary'>承認する</button></td>
                </form>
                @endif
                <form action="{{ route('comment.delete', ['comment' => $commentValue]) }}" method='post' id="comment-form">
                    @csrf
                    <td><button class='button is-danger'>削除する</button></td>
                </form>
            </tr>
        @endforeach
        </table>
        {{ $comment["value"]->links() }}
    </div>
    @endforeach
</section>
@endsection
