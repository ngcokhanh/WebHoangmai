@extends('Admin.layout.main')

@section('content')
    <style>
        .admin-container {
            padding: 2rem;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 2rem auto;
            max-width: 1200px;
        }

        .admin-container h2 {
            color: #ff6600;
            margin-bottom: 1rem;
            text-align: center;
        }

        .admin-btn-primary {
            background-color: #ff6600;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .admin-btn-primary:hover {
            background-color: #e65c00;
        }

        .admin-btn-danger {
            background-color: #ff0000;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border-radius: 5px;
        }

        .admin-btn-danger:hover {
            background-color: #cc0000;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .admin-table th,
        .admin-table td {
            padding: 0.5rem;
            border: 1px solid #ddd;
            text-align: left;
        }

        .admin-table th {
            background-color: #ff6600;
            color: white;
        }

        .admin-table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .admin-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .admin-actions {
            display: flex;
            gap: 0.5rem;
        }

        .admin-actions form {
            display: inline;
        }
    </style>

    <div class="admin-container">
        <h2>Quản lý người dùng</h2>
        <a href="{{ route('admin.users.create') }}" class="admin-btn-primary">Thêm người dùng</a>
        <table class="admin-table admin-table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Quyền</th>
                    <th>Số Điện Thoại</th>
                    <th>Địa Chỉ</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><img src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="admin-avatar"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td class="admin-actions">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="admin-btn-danger"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection