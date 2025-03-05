@extends('Client.Layout.main')

@section('content')
    <style>
        .account-info {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .account-info h2 {
            color: #ff6600;
            margin-bottom: 1rem;
            text-align: center;
        }

        .account-info .info-group {
            margin-bottom: 1rem;
        }

        .account-info .info-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .account-info .info-group p {
            margin: 0;
            padding: 0.5rem;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .account-info .info-group img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 1rem;
        }

        .account-info .admin-btn {
            display: block;
            width: 100%;
            padding: 0.5rem;
            background-color: #ff6600;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin-top: 1rem;
            text-decoration: none;
        }

        .account-info .admin-btn:hover {
            background-color: #e65c00;
        }
    </style>

    <div class="account-info">
        <h2>Thông Tin Tài Khoản</h2>
        <div class="info-group">
            <label for="avatar">Avatar</label>
            <img src="{{ Storage::url($user->avatar) }}" alt="Avatar">
        </div>
        <div class="info-group">
            <label for="name">Tên</label>
            <p id="name">{{ $user->name }}</p>
        </div>
        <div class="info-group">
            <label for="email">Email</label>
            <p id="email">{{ $user->email }}</p>
        </div>
        <div class="info-group">
            <label for="role">Vai Trò</label>
            <p id="role">{{ $user->role }}</p>
        </div>
        <div class="info-group">
            <label for="phone">Số Điện Thoại</label>
            <p id="phone">{{ $user->phone }}</p>
        </div>
        <div class="info-group">
            <label for="address">Địa Chỉ</label>
            <p id="address">{{ $user->address }}</p>
        </div>
        @if($user->role == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="admin-btn">Quản Lý Admin</a>
        @endif
    </div>
@endsection