<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Data Admin</title>
</head>
@extends('admin.sidebar')
<body>
    @section('content')
    <div class="container mt-4">
        <h2>Data Admin</h2>
        <a href="{{ url('/register') }}" class="btn btn-primary mb-3">Tambah Admin</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Admin</th>
                    <th>Email</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($all_admins as $admin_item)
                <tr>
                    <td>{{ $admin_item->nama_admin }}</td>
                    <td>{{ $admin_item->email }}</td>
                    <td>
                        <form action="{{ url('delete_admin') }}" method="POST" style="display:inline;">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="id" value="{{ $admin_item->id }}">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
</body>
</html>