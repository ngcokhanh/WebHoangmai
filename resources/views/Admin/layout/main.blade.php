<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
        }

        .navbar {
            background-color: #ff6600;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            border-radius: 5px;
            height: 40px;
            margin-right: 1rem;
        }

        .navbar .account {
            display: flex;
            align-items: center;
        }

        .navbar .account button {
            background-color: white;
            color: #ff6600;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border-radius: 5px;
            margin-left: 25px;
        }

        .container {
            display: flex;
        }

        .left-menu {
            width: 200px;
            background-color: #ffcc99;
            padding: 1rem;
            height: 100vh;
        }

        .left-menu ul {
            list-style: none;
            padding: 0;
        }

        .left-menu ul li {
            margin-bottom: 1rem;
        }

        .left-menu ul li a {
            color: #ff6600;
            text-decoration: none;
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            background-color: white;
        }

        .left-menu ul li a:hover {
            background-color: #ff6600;
            color: white;
        }

        .content {
            flex: 1;
            padding: 2rem;
        }

        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup-content {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
        }

        .popup-content p {
            margin-bottom: 1rem;
            font-size: 1.2rem;
            color: #333;
        }

        .popup-content button {
            background-color: #ff6600;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1rem;
        }

        .popup-content button:hover {
            background-color: #e65c00;
        }
    </style>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <img src="{{ Storage::url('images/LOGOHM.jpg') }}" alt="Logo">
            <h1>Admin Dashboard</h1>
        </div>

        <div class="account">
            <a href="{{ route('home') }}"><button>Trang Chủ</button></a>
            <a href="{{ route('admin.account') }}"><button>Tài Khoản</button></a>
        </div>
    </div>
    <div class="container">
        <div class="left-menu">
            <ul>
                <li><a href="{{ route('admin.users.index') }}">Quản Lý Người Dùng</a></li>
                <li><a href="{{ route('admin.posts.index') }}">Quản Lý Bài Viết</a></li>
                <li><a href="{{ route('admin.banners.index') }}">Quản Lý Banner</a></li>
                <li><a href="{{ route('admin.intros.index') }}">Quản Lý Giới Thiệu</a></li>
                <li><a href="{{ route('admin.categories.index') }}">Quản Lý Danh Mục</a></li>
            </ul>
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>

    @if(session('success'))
        <div class="popup-overlay">
            <div class="popup-content">
                <p>{{ session('success') }}</p>
                <button onclick="closePopup()">Đóng</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="popup-overlay">
            <div class="popup-content">
                <p>{{ session('error') }}</p>
                <button onclick="closePopup()">Đóng</button>
            </div>
        </div>
    @endif

    <script>
        function closePopup() {
            document.querySelector('.popup-overlay').style.display = 'none';
        }
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'underline', '|',
                    'fontFamily', 'fontSize', 'fontColor', 'bulletedList', 'numberedList',
                    '|', 'blockQuote', 'mediaEmbed', 'undo', 'redo'
                ],
                fontFamily: {
                    options: [
                        'default', 'Arial, sans-serif', 'Courier New, Courier, monospace',
                        'Georgia, serif', 'Times New Roman, Times, serif', 'Verdana, sans-serif'
                    ]
                },
                fontSize: {
                    options: ['small', 'default', 'big', '18px', '24px', '32px'],
                    supportAllValues: true
                },
                fontColor: {
                    columns: 6,
                    documentColors: 12
                },
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>


</body>

</html>