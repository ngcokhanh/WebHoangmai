@extends('Admin.layout.main')

@section('content')
    <style>
        .admin-container {
            padding: 2rem;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 2rem auto;
            max-width: 800px;
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

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            width: 100%;
            padding: 0.5rem;
            background-color: #ff6600;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 1rem;
        }

        .form-group button:hover {
            background-color: #e65c00;
        }
    </style>

    <div class="admin-container">
        <h2>Sửa Danh Mục</h2>
        @if ($errors->any())
            <div class="toast show position-fixed top-0 end-0 p-3" style="z-index: 1050">
                <div class="toast-header bg-danger text-white">
                    <strong class="me-auto">Lỗi!</strong>
                </div>
                <div class="toast-body">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Tên Danh Mục</label>
                <input type="text" id="name" name="name" value="{{ $category->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Mô Tả Danh Mục</label>
                <input type="text" id="description" name="description" value="{{ $category->description }}">
            </div>
            <div class="form-group">
                <button type="submit">Cập Nhật Danh Mục</button>
            </div>
        </form>
    </div>
@endsection