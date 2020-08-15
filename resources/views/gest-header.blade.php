
<div class="gest-header">

<div class="gest-header__top-bar">
    <a href="{{ route('top') }}"><img class="header-logo" src="/images/healthylife-top-logo.png"></a>
    <div class="auth-nav">
        <div class="welcome-message welcome-message__gest">Healthy Lifeへようこそ！</div>
        <a class="nav-link nav-link__gest" href="/">トップ</i></a>
        <a class="nav-link nav-link__gest" href="{{ route('login') }}">ログイン</a>
        @if (Route::has('register'))
            <a class="nav-link nav-link__gest" href="{{ route('register') }}">新規登録</a>
        @endif
    </div>
</div>

<div class="gest-header__content">
    <h1>毎日の栄養管理を</h1>
    <h1>アプリ１つで簡単に</h1>
    <h4>グラフで日々の栄養バランスをすぐに把握!!</h4>
    <h5>Healthy Life は日々の食事を記録し、データ化。</h5>
    <h5>食の安全を考え、happyを提供します。</h5>
</div>
<div class="search-form-container">
    <form action="{{ route('posts.search') }}" method="get" class="search-form">
        <input type="text" class="search-input" placeholder="レシピ検索" name="search">
        <button class="search-btn" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>
</div>