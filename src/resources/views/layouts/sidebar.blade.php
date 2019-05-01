<aside class="menu">
    <div class='is-child box'>
        <p class="menu-label">
            最新の記事
        </p>
        <ul class="menu-list">
            @foreach ($newArticles as $newArticle)
            <li><a href='{{ route("article.show", ["id" => $newArticle->id]) }}'>{{ $newArticle->title }}</a></li>
            @endforeach
        </ul>
    </div>
</aside>
