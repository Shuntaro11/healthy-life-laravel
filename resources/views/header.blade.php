
<div class="header-container">
    <div class="header-container-top-bar">
    <a href="{{ route('top') }}"><img class="header-logo" src="/healthylifelogo.png"></a>
        <div class="auth-nav">
            @auth
                <div class="welcome-message">ログイン中 : {{Auth::user()->name}}</div>
                <a class="nav-link" href="/">トップ</i></a>
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    ログアウト
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <div class="welcome-message">Healthy Lifeへようこそ！</div>
                <a class="nav-link" href="/">トップ</i></a>
                <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                @if (Route::has('register'))
                    <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                @endif
            @endauth
        </div>
    </div>
    
    <form action="{{ route('posts.search') }}" method="get" class="search-form">
        <input type="text" class="search-input" placeholder="レシピ検索" name="search">
        <button class="search-btn" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>