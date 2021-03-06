@extends('template')

@section('title', 'レシピランキング')

@section('content')

    @auth
        @include("header")
    @else
        @include("gest-header")
        <a href="/users/confirm"><div class="confirm-link">ヘルシーライフに登録すると様々な機能が利用できます！！</div></a>
    @endauth

    <div class="page-title"><i class="fas fa-crown"></i>人気レシピ TOP10<i class="fas fa-crown"></i></div>

    <div class="main-container">
        <?php $i=0; ?>
        @foreach($posts as $post)
            <?php $i++; ?>
            <div class="ranking-number"><i class="fas fa-medal ranking-number-{{ $i }}"></i>{{ $i }}</div>
            <div class="each-post">
                <div class="top-bar">
                    <div class="user-info">
                        <div class="image-wrapper user-image-wrapper">
                            <a href="/users/{{$post->user->id}}"><img class="inside-image" src="{{ $post->user->user_image }}" onerror="this.src='/images/noicon.png'"></a>
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

    @include("nav-bar")
    @include("footer")
    
    <script src="{{ asset('js/app.js') }}" defer></script>

@endsection