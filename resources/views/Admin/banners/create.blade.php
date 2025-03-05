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

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group textarea {
            height: 100px;
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
        <h2>Thêm Banner Mới</h2>
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

        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Hình Ảnh</label>
                <input type="file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="link">Đường Dẫn</label>
                <input type="text" id="link" name="link">
            </div>
            <div class="form-group">
                <label for="is_published">Xuất Bản</label>
                <select id="is_published" name="is_published" required>
                    <option value="1">Có</option>
                    <option value="0">Không</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Mô Tả</label>
                <textarea id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Thêm Banner</button>
            </div>
        </form>
    </div>
@endsection