@extends('template')
    <body>
        @include("header")
            <div class="page-title">プロフィール編集</div>
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
                <form action="/users" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div>
                        <p class="form-label">ユーザーネーム</p>
                        <div><input type="text" name="name" value="{{ $auth->name }}" class="post-input"></div>
                        <p class="form-label">メールアドレス</p>
                        <div><input type="email" name="email" class="post-input" value="{{ $auth->email }}"></div>
                        <p class="form-label">アイコン画像</p>
                        <div><input class="post-input-image" type="file" name="user_image" id="userEditImage" accept="image/*"></div>
                            <div class="edit-image-container">
                                <div class="preview-wrapper user-image-preview">
                                    <img class="inside-image" src="{{ $auth->user_image }}">
                                </div>
                                <i class="fas fa-angle-double-right arrow-mark"></i>
                                <div class="preview-wrapper user-image-preview">
                                    変更する場合は
                                    <br>
                                    イメージを選択してください
                                    <br>
                                    円形にリサイズされます
                                    <img class="inside-image" id="userEditImagePreview">
                                </div>
                            </div>
                        <button type="submit" class="form-button">更新</button>
                    </div>
                </form>
                <form method="post" action="/users/{{$auth->id}}">
                    <input name="_method" type="hidden" value="DELETE">
                    {{ csrf_field()}}
                        <button type="submit" class="form-button retire-button" onClick="delete_alert(event);return false;">退会する</button>
                </form>
            </div>
        @include("nav-bar")
        @include("footer")
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="{{ asset('/js/image.js') }}" defer></script>
        <script src="{{ asset('js/retire_confirm.js') }}" defer></script>
    </body>
</html>