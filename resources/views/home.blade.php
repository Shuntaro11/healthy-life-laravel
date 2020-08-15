@extends('template')

@section('title', 'top')

@section('content')
    <div class="top-page-header">

        <div class="top-page-header__top-bar">
            <a href="{{ route('top') }}"><img class="header-logo" src="/images/healthylife-top-logo.png"></a>
            <div class="auth-nav">
                @auth
                    <div class="welcome-message welcome-message__top-page">ログイン中 : {{Auth::user()->name}}</div>
                    <a class="nav-link nav-link__top-page" href="/">トップ</i></a>
                    <a class="nav-link nav-link__top-page" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        ログアウト
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <div class="welcome-message">Healthy Lifeへようこそ！</div>
                    <a class="nav-link nav-link__top-page" href="/">トップ</i></a>
                    <a class="nav-link nav-link__top-page" href="{{ route('login') }}">ログイン</a>
                    @if (Route::has('register'))
                        <a class="nav-link nav-link__top-page" href="{{ route('register') }}">新規登録</a>
                    @endif
                @endauth
            </div>
        </div>

        <div class="top-page-header__content">
            <h1>毎日の栄養管理を</h1>
            <h1>アプリ１つで簡単に</h1>
            <h4>グラフで日々の栄養バランスをすぐに把握!!</h4>
            <h5>CARE KITCHEN は日々の健康を蓄積し、データ化。</h5>
            <h5>食の安全を考え、happyを提供します。</h5>
        </div>
        
    </div>
    
    @include("nav-bar")
    @include("footer")
@endsection