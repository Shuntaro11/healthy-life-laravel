@extends('template')
    <body>
        @include("header")
            <div class="page-title">サインイン</div>
            <div class="post-form-container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="form-label">メールアドレス</div>
                    <div><input id="email" type="email" name="email" class="post-input" value="{{ old('email') }}" required autocomplete="email" autofocus></div>

                    <div class="form-label">パスワード</div>
                    <div><input id="password" type="password" name="password" class="post-input" required autocomplete="current-password"></div>

                    <button type="submit" class="form-button">ログイン</button>

                </form>
            </div>
            @include("footer")
        
    </body>
</html>