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
    </style>

    <div class="category-posts">
        <div class="map-container">
            <h2>Bản Đồ Di Tích Hoàng Mai</h2>
            <img id="map-image" src="{{ Storage::url('images/Bandoditichhm.jpg') }}" usemap="#image-map" width="800"
                height="490">
            <map name="image-map">
                <area shape="circle" coords="375,88,10" href="{{route('post.detail', '13')}}" alt="Khu tưởng niệm HVT">
                <area shape="circle" coords="353,95,10" href="{{route('post.detail', '18')}}" alt="Chùa nga my">
                <area shape="circle" coords="431,108,10" href="{{route('post.detail', '11')}}" alt="Đình Mai động">
                <area shape="circle" coords="327,122,10" href="{{route('post.detail', '10')}}" alt="Đình Tương mai">
                <area shape="circle" coords="427,148,10" href="{{route('post.detail', '12')}}" alt="Đền lư giang">
                <area shape="circle" coords="588,226,10" href="{{route('post.detail', '16')}}" alt="Chùa nam dư hạ">
                <area shape="circle" coords="606,224,10" href="{{route('post.detail', '15')}}" alt="Đình Nam dư hạ">
                <area shape="circle" coords="268,327,10" href="{{route('post.detail', '17')}}" alt="Chùa tứ kỳ">
                <area shape="circle" coords="407,272,10" href="{{route('post.detail', '19')}}" alt="Công viên yên sở">
                <area shape="circle" coords="184,348,10" href="{{route('post.detail', '20')}}" alt="Hồ linh đàm">
                <area shape="circle" coords="240,160,10" href="{{route('post.detail', '14')}}" alt="Công viên yên sở">
            </map>
        </div>

        <script>
            function scaleMap() {
                let img = document.getElementById("map-image");
                let originalWidth = 800; // Kích thước gốc của ảnh
                let originalHeight = 490;

                let currentWidth = img.clientWidth;
                let currentHeight = img.clientHeight;

                let scaleX = currentWidth / originalWidth;
                let scaleY = currentHeight / originalHeight;

                document.querySelectorAll("area").forEach(area => {
                    let coords = area.dataset.originalCoords.split(",").map(Number);
                    let newCoords = coords.map((value, index) =>
                        index % 2 === 0 ? Math.round(value * scaleX) : Math.round(value * scaleY)
                    );
                    area.coords = newCoords.join(",");
                });
            }

            window.onload = function () {
                document.querySelectorAll("area").forEach(area => {
                    area.dataset.originalCoords = area.coords; // Lưu tọa độ gốc
                });
                scaleMap();
            };

            window.onresize = scaleMap; // Cập nhật tọa độ khi thay đổi kích thước
        </script>

        <h2>Bài Viết Cùng Danh Mục</h2>
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