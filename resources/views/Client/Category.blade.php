@extends('Client.Layout.main')

@section('content')
    <style>
        .category-posts {
            padding: 2rem;
            background-color: #fff;
            color: #333;
        }

        .category-posts h2 {
            color: #ff6600;
            margin-bottom: 1rem;
        }

        .posts {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .post {
            width: 22%;
            background-color: #ffcc99;
            margin: 1rem 0;
            padding: 1rem;
            border-radius: 5px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .post img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .post h3 {
            color: #ff6600;
            margin: 1rem 0;
            flex-grow: 1;
        }

        .post .btn {
            background-color: #ff6600;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }

        .map-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        #map-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .post {
                width: 45%;
            }
        }

        @media (max-width: 480px) {
            .post {
                width: 100%;
            }
        }
    </style>

    <div class="category-posts">
        <h2>Bài Viết Cùng Danh Mục {{ $category->name }}</h2>
        <div class="posts">
            @foreach ($posts as $post)
                <div class="post">
                    <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}">
                    <h3>{{ $post->title }}</h3>
                    <a href="{{ route('post.detail', $post->id) }}" class="btn">Xem Chi Tiết</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection