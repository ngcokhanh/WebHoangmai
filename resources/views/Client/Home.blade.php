@extends('Client.Layout.main')

@section('content')
    <style>
        /* Scoped CSS for Home.blade.php */
        .home-article {
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

        .home-article img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .home-article h3 {
            color: #ff6600;
            margin: 1rem 0;
            flex-grow: 1;
        }

        .home-article .btn {
            background-color: #ff6600;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }

        .home-slideshow {
            width: 100%;
            height: 500px;
            margin: auto;
            overflow: hidden;
            position: relative;
            /* border-radius: 10px; */
        }

        .home-slideshow .swiper {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .home-slideshow .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .home-slideshow img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* border-radius: 10px; */
        }

        .home-introduction {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
            background-color: #fff;
            margin: 2rem 0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .home-introduction img {
            width: 100%;
            max-width: 600px;
            height: auto;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .home-introduction h2 {
            color: #ff6600;
            margin-bottom: 1rem;
            text-align: center;
        }

        .home-introduction p {
            color: #666;
            text-align: center;
            max-width: 800px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .home-article {
                width: 45%;
            }

            .home-slideshow {
                height: 300px;
            }

            .home-introduction {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .home-article {
                width: 100%;
            }

            .home-slideshow {
                height: 200px;
            }

            .home-introduction {
                padding: 0.5rem;
            }
        }
    </style>

    <div class="home-slideshow">
        <div class="home-slideshow swiper">
            <div class="swiper-wrapper">
                @foreach($banners as $banner)
                    <div class="swiper-slide">
                        <a href="{{ $banner->link }}" style="width: 100%; height: 100%;">
                            <img src="{{ Storage::url($banner->image) }}" alt="Banner">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="motto">
        "Dấu ấn Hoàng Mai - Xây dựng tương lai"
    </div>
    <div class="featured-articles">
        <h2>Bài Viết Mới Nhất</h2>
        <div class="articles">
            @foreach ($posts as $item)
                <div class="home-article">
                    <img src="{{Storage::url($item->image)}}" alt="{{ $item->title }}">
                    <h3>{{ $item->title }}</h3>
                    <a href="{{ route('post.detail', $item->id) }}" class="btn">Xem Chi Tiết</a>
                </div>
            @endforeach
        </div>
    </div>

    @foreach ($intros as $intro)
        <div class="home-introduction">
            <div>
                <a href="{{ route('gioithieu') }}">
                    <h2>{{$intro->title}}</h2>
                </a>
                <p>
                    {{Str::limit($intro->content, 500)}}
                </p>
            </div>
            <img src="{{ Storage::url($intro->image) }}" alt="{{ $intro->image }}">
        </div>
    @endforeach

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".swiper", {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
@endsection