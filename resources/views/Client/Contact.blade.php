@extends('Client.Layout.main')

@section('content')
    <style>
        .contact-page {
            padding: 2rem;
            background-color: #fff;
            color: #333;
            max-width: 800px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .contact-page h2 {
            color: #ff6600;
            margin-bottom: 1rem;
            text-align: center;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
        }

        .contact-form label {
            margin-bottom: 0.5rem;
            color: #666;
        }

        .contact-form input,
        .contact-form textarea {
            margin-bottom: 1rem;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
        }

        .contact-form button {
            background-color: #ff6600;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s, color 0.3s;
        }

        .contact-form button:hover {
            background-color: #e65c00;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-page {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {}

        .contact-page {
            padding: 0.5rem;
        }
    </style>

    <div class="contact-page">
        <h2>Góp ý</h2>
        <form class="contact-form" action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <label for="name">Tên của bạn</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email của bạn</label>
            <input type="email" id="email" name="email">

            <label for="phone">Số điện thoại của bạn</label>
            <input type="text" id="phone" name="phone" required>

            <label for="address">Địa chỉ</label>
            <input type="text" id="address" name="address">

            <label for="content">Nội dung</label>
            <textarea id="content" name="content" rows="5" required></textarea>

            <button type="submit">Gửi</button>
        </form>
    </div>
@endsection