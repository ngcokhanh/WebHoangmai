@extends('Client.Layout.main')

@section('content')
    <style>
        .post-detail {
            padding: 2rem;
            background-color: #fff;
            color: #333;
            max-width: 1000px;
            /* Adjust the max-width as needed */
            margin: 0 auto;
            /* Center the content */
        }

        .post-detail h1 {
            color: #ff6600;
            margin-bottom: 1rem;
        }

        .post-detail p {
            color: #666;
            margin-bottom: 1rem;
        }

        .post-detail img {
            width: 100%;
            max-height: 400px;
            object-fit: contain;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .post-content {
            margin-bottom: 2rem;
        }

        .post-video {
            justify-content: center;
            align-items: center;
            display: flex;
            margin-top: 2rem;
        }

        .post-video video {
            width: 80%;
            border-radius: 10px;
        }
    </style>

    <div class="post-detail">
        <h1>{{ $post->title }}</h1>
        @if ($post->linkquiziz)
            <a href="{{ $post->linkquiziz }}" target="_blank">Tham gia bài quiziz</a>
        @endif
        <p><em>Đăng vào: {{ $post->created_at }}</em></p>
        <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}">
        <div class="post-content">
            {!! $post->content !!}
        </div>
        @if($post->video)
            <div class="post-video">
                <video controls>
                    <source src="{{ Storage::url($post->video) }}" type="video/mp4">
                    Trình duyệt của bạn không hỗ trợ video.
                </video>
            </div>
        @endif
    </div>
@endsection