@extends('Admin.layout.main')

@section('content')
    <style>
        .contacts-page {
            padding: 2rem;
            background-color: #fff;
            color: #333;
        }

        .contacts-page h2 {
            color: #ff6600;
            margin-bottom: 1rem;
        }

        .contacts-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        .contacts-table th,
        .contacts-table td {
            border: 1px solid #ddd;
            padding: 0.5rem;
            text-align: left;
        }

        .contacts-table th {
            background-color: #ffcc99;
            color: #333;
        }

        .contacts-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .contacts-table tr:hover {
            background-color: #f1f1f1;
        }

        .contacts-table .btn {
            background-color: #ff6600;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }

        .contacts-table .btn:hover {
            background-color: #e65c00;
        }
    </style>

    <div class="contacts-page">
        <h2>Danh Sách Liên Hệ</h2>
        <table class="contacts-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Nội Dung</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->content }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection