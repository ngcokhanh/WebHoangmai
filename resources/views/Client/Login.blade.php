@extends('Client.Layout.main')

@section('content')
    <style>
        .login-form {
            max-width: 400px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            color: #ff6600;
            margin-bottom: 1rem;
            text-align: center;
        }

        .login-form .form-group {
            margin-bottom: 1rem;
        }

        .login-form .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .login-form .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-form .form-group button {
            width: 100%;
            padding: 0.5rem;
            background-color: #ff6600;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 1rem;
        }

        .login-form .form-group button:hover {
            background-color: #e65c00;
        }

        .login-form .register-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: #ff6600;
            text-decoration: none;
        }

        .login-form .register-link:hover {
            text-decoration: underline;
        }
    </style>

    <div class="login-form">
        <h2>Đăng Nhập</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mật Khẩu</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Đăng Nhập</button>
            </div>
        </form>
        <a href="{{ route('register') }}" class="register-link">Đăng Ký</a>
    </div>
@endsection