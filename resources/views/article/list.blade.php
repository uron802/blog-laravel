@extends('layouts.app-admin')

@section('content')

    <div class="tabs">
        <ul>
            <li id="tab-publish" class="tab is-active"><a>公開</a></li>
            <li id="tab-private" class="tab"><a>下書き</a></li>
            <li id="tab-all" class="tab"><a>すべて</a></li>
        </ul>
    </div>
    @foreach ($articles as $article)
    <div class="tab-page tab-{{ $article["key"] }} {{ $article["tab_page_class"] }}">
        <table class='table'>
            <tr>
                <th>状況</th>
                <th>タイトル</th>
                <th>投稿時間</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($article["value"] as $articleValue)
            <tr>
                @if($articleValue->publish == "1")
                <td><span class='tag is-success'>公開</span></td>
                @else
                <td><span class='tag'>下書き</span></td>
                @endif
                <td>{{ $articleValue->title }}</td>
                <td>{{ $articleValue->post_date_time }}</td>
                <td><a class='button is-primary' href="{{ route('article.edit', ['article' => $articleValue]) }}">編集する</a></td>
                <form action="{{ route('article.delete', ['article' => $articleValue]) }}" method='post' id="article-form">
                    @csrf
                    <td><button class='button is-danger'>削除する</button></td>
                </form>
                @if($articleValue->publish == "1")
                <td><a class='button' href="{{ route('article.show', ['article' => $articleValue]) }}">記事を見る</a></td>
                @else
                <td></td>
                @endif
            </tr>
            @endforeach
        </table>
        {{ $article["value"]->links() }}
    </div>
    @endforeach
@endsection
