@extends('template')
    <body>
        @include("header")
        <div class="page-title">レシピ</div>
  
        <div class="post-form-container">
            @auth
                <div class="post-edit-link">
                    @if($post->user_id === Auth::user()->id)
                        <a href="/posts/{{$post->id}}/edit">
                            <div class="delete-link">レシピを編集する</div>
                        </a>
                        <form method="post" action="/posts/{{$post->id}}">
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field()}}
                                <button type="submit" class="delete-link" onClick="delete_alert(event);return false;">レシピを削除する</button>
                        </form>
                    @endif
                </div>
            @endauth
            <div class="recipe-top-bar">

                <div class="user-info">
                    <a href="/users/{{$post->user->id}}"><div class="image-wrapper user-image-wrapper">
                        <img class="inside-image" src="{{ $post->user->user_image }}" onerror="this.src='/noicon.png'">
                    </div></a>
                    <a href="/users/{{$post->user->id}}"><div class="user-name">{{ $post->user->name }}</div></a>
                </div>
                <div id="app">
                    @auth
                        <like
                            :post-id="{{ json_encode($post->id) }}"
                            :user-id="{{ json_encode(Auth::user()->id) }}"
                            :default-Liked="{{ json_encode($defaultLiked) }}"
                            :default-Count="{{ json_encode($defaultCount) }}"
                        ></like>
                    @else
                        <div class="like-box">
                            <a href="/users/confirm"><p class="like-btn-wrapper"><i class="far fa-heart like-button"></i></p></a>
                            <p class="like-count">{{ $post->likes->count() }} 件</p>
                        </div>
                    @endauth
                </div>
            </div>
            
            <div class="recipe-show-title">{{ $post->title }}</div>

            <div class="image-wrapper post-show-image-wrapper">
                <img class="inside-image" src="{{ $post->image }}">
            </div>

            <div class="recipe-show-content">{!! nl2br(e($post->content)) !!}</div>

            <div class="post-tags post-tags-show-page">タグ：
                @foreach($post->tags as $tag)
                    <a href="{{ route('top', ['name' => $tag->name]) }}">#{{ $tag->name }}</a>
                @endforeach
            </div>

            <p class="recipe-date">公開日：{{ $post->created_at->format('Y/m/d H:i:s') }}</p>

        </div>

        <div class="comment-container">
            @auth
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/comments" method="post" enctype="multipart/form-data" class="comment-form">
                    @csrf
                    <div><textarea name="comment" class="comment-input" rows="2" placeholder="コメントを追加"></textarea></div>
                    <input name="post_id" type="hidden" value="{{$post->id}}">
                    <button type="submit" class="comment-btn">投稿する</button>
                </form>
            @else
                <div class="comment-form">
                    <div><p class="comment-input comment-input-guest">ログイン後コメントができます</p></div>
                </div>
            @endauth
            <div class="comment-index">
                <div class="comment-index-title">コメント一覧</div>
                @foreach($post->comments as $comment)
                    <p class="comment-user-name">{{ $comment->user->name }}</p>
                    <div class="comment-content">{{ $comment->comment }}</div>
                    @auth
                        @if($comment->user_id === Auth::user()->id)
                            <form method="post" action="/comments/{{$comment->id}}">
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field()}}
                                <button type="submit" class="delete-link" onClick="delete_alert(event);return false;">コメントを削除する</button>
                            </form>
                        @endif
                    @endauth
                @endforeach
            </div>
        </div>
        
        @include("nav-bar")
        @include("footer")
        
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/delete_confirm.js') }}" defer></script>
    </body>
</html>