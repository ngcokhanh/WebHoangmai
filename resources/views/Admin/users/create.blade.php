@extends('Admin.layout.main')

@section('content')
    <style>
        .create-user-form {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .create-user-form h2 {
            color: #ff6600;
            margin-bottom: 1rem;
            text-align: center;
        }

        .create-user-form .form-group {
            margin-bottom: 1rem;
        }

        .create-user-form .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .create-user-form .form-group input,
        .create-user-form .form-group select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .create-user-form .form-group button {
            width: 100%;
            padding: 0.5rem;
            background-color: #ff6600;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 1rem;
        }

        .create-user-form .form-group button:hover {
            background-color: #e65c00;
        }
    </style>

    <div class="create-user-form">
        <h2>Thêm Người Dùng Mới</h2>
        @if ($errors->any())
            <div class="toast show position-fixed top-0 end-0 p-3" style="z-index: 1050">
                <div class="toast-header bg-danger text-white">
                    <strong class="me-auto">Lỗi!</strong>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="toast"></button> -->
                </div>
                <div class="toast-body">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file" id="avatar" name="avatar">
            </div>
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
                <label for="role">Quyền</label>
                <select id="role" name="role" required>
                    <option value="client">Client</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone">Số Điện Thoại</label>
                <input type="text" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="address">Địa Chỉ</label>
                <input type="text" id="address" name="address">
            </div>
            <div class="form-group">
                <button type="submit">Thêm Người Dùng</button>
            </div>
        </form>
    </div>
@endsection