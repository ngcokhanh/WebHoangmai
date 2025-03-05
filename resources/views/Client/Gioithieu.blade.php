@extends('Client.Layout.main')

@section('content')
    <style>
        .introduction-page {
            padding: 2rem;
            background-color: #fff;
            color: #333;
            width: 100%;
            max-width: 1400px;
            margin: auto;
        }

        .introduction-page h1 {
            color: #ff6600;
            margin-bottom: 1rem;
        }

        .introduction-page p {
            color: #666;
            margin-bottom: 1rem;
        }

        .introduction-page img {
            width: 100%;
            max-width: 800px;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 1rem;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .introduction-content {
            margin-bottom: 2rem;
        }

        .introduction-video {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2rem;
        }

        .introduction-video video {
            width: 100%;
            max-width: 800px;
            border-radius: 10px;
        }
    </style>

    <div class="introduction-page">
        @foreach ($intros as $intro)
            <h1>{{ $intro->title }}</h1>
            <img src="{{ Storage::url($intro->image) }}" alt="{{ $intro->title }}">
            <div class="introduction-content">
                {!! $intro->content !!}
            </div>
            @if($intro->video)
                <div class="introduction-video">
                    <video controls>
                        <source src="{{ Storage::url($intro->video) }}" type="video/mp4">
                        Trình duyệt của bạn không hỗ trợ video.
                    </video>
                </div>
            @endif
        @endforeach
    </div>
  
@endsection