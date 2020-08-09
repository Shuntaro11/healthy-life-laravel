@extends('template')
    <body>
        @include("header")
        <div class="show-user-name">{{ $user->name }}</div>
        <div class="image-wrapper show-user-image-wrapper">
            <img class="inside-image" src="{{ $user->user_image }}" onerror="this.src='/noicon.png'">
        </div>
        @auth
            @if($user->id === Auth::user()->id)
            <a href="/users/{{$user->id}}/edit">
                <div class="user-edit-link">プロフィール編集</div>
            </a>
            @endif
        @endauth

        <p class="container-title">{{ $user->name }} の投稿一覧</p>
        <div class="user-post-index">
            @foreach($user_posts as $post)
                <a href="{{ route('posts.show', $post->id) }}">
                    <div class="image-wrapper user-post-image-wrapper">
                        <img class="inside-image" src="{{ $post->image }}">
                        <div class="hover-wrap">
                            <div class="hover-post-title">{{$post->title}}</div>
                            <div>
                                @foreach($post->tags as $tag)
                                <p class="hover-tag">#{{$tag->name}}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        @include("nav-bar")
        @include("footer")
        
    </body>
</html>