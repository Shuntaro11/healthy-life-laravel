@extends('template')
    <body>
        @include("header")
            <div class="page-title">レシピ編集</div>
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
                
                <form action="{{ route('posts.update', ['post' => $post]) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                        @csrf
                    <div>
                        <p class="form-label">レシピタイトル</p>
                        <p class="post-form-notice">料理名を30文字以内で入力してください</p>
                        <div class="post-title-wrapper"><input type="text" name="title" value="{{ $post->title }}" class="post-input" size="30" ></div>
                        <p class="form-label">料理の写真</p>
                        <div><input class="post-input-image" type="file" name="image" id="recipeImage" accept="image/*"></div>
                        <div class="edit-image-container">
                            <div class="preview-wrapper food-image-preview">
                                    <img class="inside-image" src="{{ $post->image }}">
                                </div>
                                <i class="fas fa-angle-double-right arrow-mark"></i>
                            <div class="preview-wrapper food-image-preview">
                                変更する場合は
                                <br>
                                イメージを選択してください
                                <br>
                                正方形にリサイズされます
                                <img class="inside-image" id="recipeImagePreview">
                            </div>
                        </div>
                        <p class="form-label">作り方</p>
                        <p class="post-form-notice">料理概要を2000文字以内で自由に入力してください</p>
                        <div class="post-info-wrapper">
                            <textarea class="post-info-input" name="content" rows="20" placeholder="300字以内で入力">{!! ($post->content) !!}</textarea>
                        </div>
                        <button class="form-button" type="submit">更新</button>
                    </div>
                </form>
            </div>
        </div>
        @include("nav-bar")
        @include("footer")
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="{{ asset('/js/image.js') }}"></script>
    </body>
</html>