@extends('layouts.app-admin')

@section('content')
    <table class='table'>
        <tr>
            <th>状況</th>
            <th>タイトル</th>
            <th>投稿時間</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    @foreach ($articles as $article)
        <tr>
            @if($article->publish == "1")
            <td><span class='tag is-success'>公開</span></td>
            @else
            <td><span class='tag'>下書き</span></td>
            @endif
            <td>{{ $article->title }}</td>
            <td>{{ $article->post_date_time }}</td>
            <td><a class='button is-primary' href="{{ route('article.edit', ['article' => $article]) }}">編集する</a></td>
            <form action="{{ route('article.delete', ['article' => $article]) }}" method='post' id="article-form">
                @csrf
                <td><button class='button is-danger'>削除する</button></td>
            </form>
            @if($article->publish == "1")
            <td><a class='button' href="{{ route('article.show', ['article' => $article]) }}">記事を見る</a></td>
            @else
            <td></td>
            @endif
        </tr>
    @endforeach
    </table>
    {{ $articles->links() }}
@endsection
