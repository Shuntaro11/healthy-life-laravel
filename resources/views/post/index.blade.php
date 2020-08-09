@extends('template')
    <body>
        @include("header")
        @auth

        @else
            <a href="/users/confirm"><div class="confirm-link">ヘルシーライフに登録すると様々な機能が利用できます！</div></a>
        @endauth

        @isset($search_result)
            <div class="page-title">{{ $search_result }}</div>
        @endisset
        <div class="main-container">
            @foreach($posts as $post)
                <div class="each-post">
                    <div class="top-bar">
                        <div class="user-info">
                            <div class="image-wrapper user-image-wrapper">
                                <a href="/users/{{$post->user->id}}"><img class="inside-image" src="{{ $post->user->user_image }}" onerror="this.src='/noicon.png'"></a>
                            </div>
                        <a href="/users/{{$post->user->id}}"><p class="user-name">{{ $post->user->name }}</p></a>
                        </div>
                        <a href="/users/{{$post->user->id}}" class="user-link"><i class="fas fa-user"></i></a>
                    </div>
                    <div class="post-main-container">
                        <a href="{{ route('posts.show', $post->id) }}">
                            <div class="image-wrapper post-image-wrapper">
                                <img class="inside-image" src="{{ $post->image }}">
                            </div>
                        </a>
                        <div class="right-box">
                            <a href="{{ route('posts.show', $post->id) }}">
                                <div class="post-title">{{ $post->title }}</div>
                            </a>
                            <div class="post-content">{!! nl2br(e($post->content)) !!}</div>
                            <div class="post-tags">タグ：
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('top', ['name' => $tag->name]) }}">#{{ $tag->name }}</a>
                                @endforeach
                            </div>
                            <div class="under-bar">
                                <p class="post-date">{{ $post->created_at->format('Y/m/d H:i:s') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="post-tags-sd">
                        タグ：
                        @foreach($post->tags as $tag)
                            <a href="{{ route('top', ['name' => $tag->name]) }}">#{{ $tag->name }}</a>
                        @endforeach
                    </div>
                    <div class="post-date-sd">{{ $post->created_at->format('Y/m/d H:i:s') }}</div>
                </div>
            @endforeach
        </div>
        <div class="pagination-wrapper">
            @if(isset($name))
                {{ $posts->appends(['name' => $name])->links() }}

            @elseif(isset($search_query))
                {{ $posts->appends(['search' => $search_query])->links() }}

            @else
                {{ $posts->links() }}
            @endif
        </div>
        @include("nav-bar")
        @include("footer")
        
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>