
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="https://github.com/uron802/blog-laravel">
            GitHub
        </a>
        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasic">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
    </div>
    <div id="navbarBasic" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="{{ url('/') }}">
                ホーム
            </a>
            @auth
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <div class="navbar-dropdown">
                    <a class="navbar-item" href="{{ route('article.list') }}">
                        記事一覧
                    </a>
                    <a class="navbar-item" href="{{ route('article.create') }}">
                        記事作成
                    </a>
                </div>
            </div>
            @endauth
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                @guest
                <div class="buttons">
                    <a class="button is-primary" href="{{ route('login') }}">
                        <strong>{{ __('Login') }}</strong>
                    </a>
                </div>
                @endguest
                @auth
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <div class="buttons">
                    <a class="button is-primary" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <strong>{{ __('Logout') }}</strong>
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
