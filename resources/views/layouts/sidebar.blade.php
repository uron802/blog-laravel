<aside class="menu">
    <div class='is-child box'>
        <p class="menu-label">
            最新の記事
        </p>
        <ul class="menu-list">
            @forelse ($newArticles as $newArticle)
            <li><a href='{{ route("article.show", ["article" => $newArticle]) }}'>{{ $newArticle->title }}</a></li>
            @empty
            @endforelse
        </ul>
    </div>
    <div class='is-child box'>
        <p class="menu-label">
            カテゴリー
        </p>
        <ul class="menu-list">
            @forelse ($sidebarTags as $sidebarTag)
            <li><a href='{{ route("article") . "?tag=" . $sidebarTag->id }}'>{{ $sidebarTag->name }}</a></li>
            @empty
            @endforelse
        </ul>
    </div>
</aside>
