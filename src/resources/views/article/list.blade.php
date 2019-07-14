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
            <td><a class='button is-primary' href="{{ route('article.edit', ['id' => $article->id]) }}">編集する</a></td>
            <td><a class='button is-danger' href="{{ route('article.delete', ['id' => $article->id]) }}">削除する</a></td>
            @if($article->publish == "1")
            <td><a class='button' href="{{ route('article.show', ['id' => $article->id]) }}">記事を見る</a></td>
            @else
            <td></td>
            @endif
        </tr>
    @endforeach
    </table>
    {{ $articles->links() }}
@endsection
