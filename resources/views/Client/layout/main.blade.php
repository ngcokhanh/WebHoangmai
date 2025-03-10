<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Trang Chủ</title>
	<link href="https://fonts.googleapis.com/css2?family=Alex+Brush&display=swap" rel="stylesheet">

	<style>
		/* Scoped CSS for main.blade.php */
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #fff;
			color: #333;
		}

		.navbar {
			background-color: white;
			padding: 1rem;
			display: flex;
			justify-content: space-between;
			align-items: center;
			position: relative;
			z-index: 10;
		}

		.navbar .logo {
			display: flex;
			align-items: center;
		}

		.navbar .logo img {
			height: 80px;
			margin-right: 1rem;
			border-radius: 10px;
		}

		.navbar .menu {
			display: flex;
			align-items: center;
			width: 100%;

		}

		.navbar .menu ul {
			list-style: none;
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: space-around;
			/* Changed from space-between to space-around */
			width: 100%;
			/* Ensure the menu takes full width */
		}

		.navbar .menu ul li {
			position: relative;
			margin: 0 1rem;
			font-family: 'Alex Brush', cursive;
			font-size: 30px;
			font-weight: bold;
			/* Hoặc dùng 700 */
		}

		.navbar .menu ul li a {
			color: rgb(247, 109, 11);
			text-decoration: none;
			padding: 0.5rem 1rem;
			display: block;
			transition: background-color 0.3s, color 0.3s;
		}

		.navbar .menu ul li a:hover {
			background-color: white;
			color: rgb(251, 46, 18);
			border-radius: 5px;
		}

		.navbar .menu ul li .btn {
			background-color: white;
			color: rgb(247, 109, 11);
			border: none;
			padding: 0.5rem 1rem;
			cursor: pointer;
			border-radius: 5px;
			transition: background-color 0.3s, color 0.3s;
			font-family: 'Alex Brush', cursive;
			font-size: 30px;
			font-weight: bold;

		}

		.navbar .menu ul li .btn:hover {
			background-color: rgb(250, 140, 67);
			color: white;
		}

		.navbar .menu ul li ul {
			display: none;
			position: absolute;
			top: 100%;
			left: 0;
			background-color: white;
			/* Set background color to white */
			box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
			z-index: 1;
		}

		.navbar .menu ul li:hover ul {
			display: block;
			/* color: #ff6600; */
		}

		.navbar .menu ul li ul li {
			width: 200px;
			font-family: 'alex brush';
		}

		.navbar .menu ul li ul li a:hover {
			background-color: white;
			color: rgb(255, 85, 0);
			border-radius: 5px;
		}

		.motto {
			/* padding: 2rem; */
			text-align: center;
			background-color: #fff;
			color: #ff6600;
			font-size: 1.5rem;
		}

		.featured-articles {
			padding: 2rem;
			text-align: center;
		}

		.featured-articles h2 {
			color: #ff6600;
		}

		.articles {
			display: flex;
			justify-content: space-around;
			flex-wrap: wrap;
		}

		.article {
			width: 22%;
			background-color: #ffcc99;
			margin: 1rem 0;
			padding: 1rem;
			border-radius: 5px;
			text-align: center;
			transition: transform 0.3s, box-shadow 0.3s;
		}

		.article:hover {
			transform: translateY(-5px);
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		.article img {
			width: 100%;
			height: auto;
			border-radius: 5px;
		}

		.article h3 {
			color: #ff6600;
			margin: 1rem 0;
		}

		.article .btn {
			background-color: #ff6600;
			color: white;
			border: none;
			padding: 0.5rem 1rem;
			cursor: pointer;
			border-radius: 5px;
			text-decoration: none;
			transition: background-color 0.3s, color 0.3s;
		}

		.article .btn:hover {
			background-color: white;
			color: #ff6600;
			border: 1px solid #ff6600;
		}

		.introduction {
			display: flex;
			padding: 2rem;
			background-color: #fff;
		}

		.introduction img {
			width: 50%;
			border-radius: 5px;
		}

		.introduction div {
			padding: 1rem;
		}

		.footer {
			background-image: url('https://upload.wikimedia.org/wikipedia/commons/e/e8/Ph%C3%A1p_V%C3%A2n_Interchange.jpg');
			background-size: cover;
			background-position: center;
			color: white;
			text-align: center;
			padding: 2rem 1rem;
		}

		.footer .footer-content {
			display: flex;
			justify-content: space-between;
			flex-wrap: wrap;
		}

		.footer .footer-section {
			flex: 1;
			padding: 1rem;
		}

		.footer .footer-section h3 {
			margin-bottom: 1rem;
		}

		.footer .footer-section ul {
			list-style: none;
			padding: 0;
		}

		.footer .footer-section ul li {
			margin-bottom: 0.5rem;
		}

		.footer .footer-section ul li a {
			color: white;
			text-decoration: none;
			transition: color 0.3s;
		}

		.footer .footer-section ul li a:hover {
			color: rgb(255, 97, 19);
		}

		.footer .social-icons {
			display: flex;
			justify-content: center;
			margin-top: 1rem;
		}

		.footer .social-icons a {
			color: white;
			margin: 0 0.5rem;
			font-size: 1.5rem;
		}

		.footer .social-icons img {
			width: 40px;
			height: 40px;
			border-radius: 50%;
			transition: transform 0.3s;
		}

		.footer .social-icons img:hover {
			transform: scale(1.1);
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
			transition: background-color 0.3s, color 0.3s;
		}

		.popup-content button:hover {
			background-color: white;
			color: #ff6600;
			border: 1px solid #ff6600;
		}

		/* Responsive Design */
		@media (max-width: 768px) {
			.navbar .menu ul {
				flex-direction: column;
			}

			.navbar .menu ul li {
				margin: 0.5rem 0;
			}

			.article {
				width: 45%;
			}

			.introduction {
				flex-direction: column;
			}

			.introduction img {
				width: 100%;
			}
		}

		@media (max-width: 480px) {
			.article {
				width: 100%;
			}

			.introduction {
				padding: 1rem;
			}

			.footer .footer-content {
				flex-direction: column;
				align-items: center;
			}

			.footer .footer-section {
				width: 100%;
				text-align: center;
			}
		}
	</style>

	<!-- Swiper CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">

	<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.3.0/ckeditor5.css">
	<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
</head>

<body>
	<div class="logo">
		<img src="{{ Storage::url('images/LOGOHMmoi.png') }}" alt="Logo">
	</div>
	<div class="navbar">
		<div class="menu">
			<ul>
				<li><a href="{{ route('home') }}">Trang Chủ</a></li>
				<li>
					<a href="#">Danh Mục</a>
					<ul>
						@foreach ($categories as $category)
							<li><a href="{{ route('category', $category->id) }}">{{ $category->name }}</a></li>
						@endforeach
					</ul>
				</li>
				<li><a href="{{ route('gioithieu') }}">Giới Thiệu</a></li>
				<li><a href="{{route('viewcontact')}}">Góp ý</a></li>
				@if(Auth::check())
					<li><a href="{{ route('logout') }}"
							onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?');"><button class="btn">Đăng
								Xuất</button></a></li>
					<li><a href="{{ route('account') }}"><button class="btn">Tài Khoản</button></a></li>
				@else
					<a href="{{ route('login') }}">
						<li><button class="btn">Đăng Nhập</button></li>
					</a>
					<a href="{{ route('register') }}">
						<li><button class="btn">Đăng Ký</button></li>
					</a>
				@endif
			</ul>
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

	@yield('content')

	<div class="footer">
		<div class="footer-content">
			<div class="footer-section">
				<img style="	height: 80px;
								margin-right: 1rem;
								border-radius: 10px;" src="{{ Storage::url('images/LOGOHMmoi.png') }}" alt="Logo">
			</div>

			<div class="footer-section">
				<h3>Danh Mục</h3>
				<ul>
					@foreach ($categories as $category)
						<li><a href="{{route('category', $category->id)	}}">{{ $category->name }}</a></li>
					@endforeach
				</ul>
			</div>

			<div class="footer-section">
				<h3>Dấu ấn Hoàng Mai</h3>
				<p>Giáo viên: Luyện Thị Điều</p>
				<p>Điện thoại: <a href="tel:0904255215">0977141082</a></p>
				<p>Địa chỉ: Trường Tiểu học Mai Động
					Số 1 Lĩnh Nam, Quận Hoàng Mai, Thành Phố Hà Nội.</p>
				<p>Email: <a href="ngocdieu19061990@gmail.com">ngocdieu19061990@gmail.com</a></p>
			</div>
			<div class="footer-section">
				<h3>Kết Nối Với Chúng Tôi</h3>
				<div class="social-icons">
					<a href="https://facebook.com" target="_blank"><img src="{{ Storage::url('images/facebook.png') }}"
							alt="Facebook"></a>
					<a href="https://zalo.com" target="_blank"><img src="{{ Storage::url('images/zalo.png') }}"
							alt="Zalo"></a>
				</div>
			</div>
		</div>
	</div>

	<script>
		function closePopup() {
			document.querySelector('.popup-overlay').style.display = 'none';
		}
	</script>


</body>

</html>