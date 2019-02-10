@extends('layouts.app')

@section('content')

    <table>
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
            <td>公開</td>
            @else
            <td>下書き</td>
            @endif
            <td>{{ $article->title }}</td>
            <td>{{ $article->post_date_time }}</td>
            <td><a href="{{ route('article.edit', ['id' => $article->id]) }}">編集</a></td>
            <td><a href="{{ route('article.delete', ['id' => $article->id]) }}">削除</a></td>
            @if($article->publish == "1")
            <td><a href="{{ route('article.show', ['id' => $article->id]) }}">記事を見る</a></td>
            @else
            <td></td>
            @endif
        </tr>
    @endforeach
    </table>
    {{ $articles->links() }}
@endsection
