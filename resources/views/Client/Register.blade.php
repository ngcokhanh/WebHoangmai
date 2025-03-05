@extends('Client.Layout.main')

@section('content')
    <style>
        .register-form {
            max-width: 400px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .register-form h2 {
            color: #ff6600;
            margin-bottom: 1rem;
            text-align: center;
        }

        .register-form .form-group {
            margin-bottom: 1rem;
        }

        .register-form .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .register-form .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .register-form .form-group button {
            width: 100%;
            padding: 0.5rem;
            background-color: #ff6600;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 1rem;
        }

        .register-form .form-group button:hover {
            background-color: #e65c00;
        }

        .register-form .login-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: #ff6600;
            text-decoration: none;
        }

        .register-form .login-link:hover {
            text-decoration: underline;
        }
    </style>

    <div class="register-form">
        <h2>Đăng Ký</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mật Khẩu</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Xác Nhận Mật Khẩu</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="form-group">
                <button type="submit">Đăng Ký</button>
            </div>
        </form>
        <a href="{{ route('login') }}" class="login-link">Đăng Nhập</a>
    </div>
@endsection