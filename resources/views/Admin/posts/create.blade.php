@extends('Admin.Layout.main')

@section('content')
    <style>
        .create-post-form {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .create-post-form h2 {
            color: #ff6600;
            margin-bottom: 1rem;
            text-align: center;
        }

        .create-post-form .form-group {
            margin-bottom: 1rem;
        }

        .create-post-form .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .create-post-form .form-group input,
        .create-post-form .form-group textarea,
        .create-post-form .form-group select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .create-post-form .form-group textarea {
            height: 150px;
        }

        .create-post-form .form-group button {
            width: 100%;
            padding: 0.5rem;
            background-color: #ff6600;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 1rem;
        }

        .create-post-form .form-group button:hover {
            background-color: #e65c00;
        }
    </style>

    <div class="create-post-form">
        <h2>Thêm Bài Viết Mới</h2>
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

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Tiêu Đề</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="image">Hình Ảnh</label>
                <input type="file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="video">Video</label>
                <input type="file" id="video" name="video">
            </div>
            <div class="form-group">
                <label for="content">Nội Dung</label>
                <textarea id="editor" name="content" required></textarea>
            </div>
            <div class="form-group">
                <label for="category">Danh Mục</label>
                <select id="category" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="is_published">Xuất Bản</label>
                <select id="is_published" name="is_published" required>
                    <option value="1">Có</option>
                    <option value="0">Không</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Thêm Bài Viết</button>
            </div>
        </form>
    </div>
@endsection