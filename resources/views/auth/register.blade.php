@extends('template')
    <body>
        @include("header")
            <div class="page-title">新規登録</div>
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
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-label">ユーザーネーム</div>
                    <div><input id="name" type="text" class="post-input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus></div>

                    <div class="form-label">メールアドレス</div>
                    <div><input id="email" type="email" name="email" class="post-input" value="{{ old('email') }}" required autocomplete="email"></div>

                    <div class="form-label">パスワード</div>
                    <div><input id="password" type="password" name="password" class="post-input" required autocomplete="current-password"></div>

                    <div class="form-label">パスワード確認</div>
                    <div><input id="password-confirm" type="password" class="post-input" name="password_confirmation" required autocomplete="new-password"></div>

                    <p class="form-label">アイコン画像</p>
                    <div><input type="file" name="user_image" id="userImage" accept="image/*"></div>
                    <div class="preview-wrapper user-image-preview">
                        イメージを選択してください
                        <br>
                        円形にリサイズされます
                    <img class="inside-image" id="userImagePreview"></div>
                    <button type="submit" class="form-button">新規登録</button>

                </form>
            </div>
            @include("footer")
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="{{ asset('/js/image.js') }}"></script>
    </body>
</html>