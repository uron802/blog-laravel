<aside class="menu">
    <div class='is-child box'>
        @auth
        <ul class="menu-list">
            <li><a href="{{ route('home') }}">ダッシュボード</a></li>
            <li><a href="{{ route('article.list') }}">記事一覧</a></li>
            <li><a href="{{ route('article.create') }}">記事作成</a></li>
            <li><a href="{{ route('comment.list') }}">コメント一覧</a></li>
            <li><a href="{{ route('tag.list') }}">カテゴリー一覧</a></li>
        </ul>
        @endauth
    </div>
</aside>
