<h4>最新の記事</h4>
<ul>
@foreach ($newArticles as $newArticle)
<li><a href='{{ route("article.show", ["id" => $newArticle->id]) }}'>{{ $newArticle->title }}</a></li>
@endforeach
</ul>
<h4>管理者用</h4>
@guest
<ul>
    <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
</ul>
@endguest
@auth
<ul>
    <li><a href="{{ route('home') }}">ダッシュボード</a></li>
    <li><a href="{{ route('article.list') }}">記事一覧</a></li>
    <li><a href="{{ route('article.create') }}">記事作成</a></li>
    <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
@endauth
