<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Kategori</title>
</head>
@extends('admin.sidebar')
<body>
    @section('content')
    <div class="container mt-4">
        <h2>Data Kategori</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $kategori)
                <tr>
                    <td><img src="{{ asset('images/' . $kategori->gambar) }}" alt="Pengguna Belum Upload Desain" style="width: 50%" height="50%"></td>
                    <td>{{ $kategori->nama }}</td>
                    <td>{{ $kategori->promosi }}</td>
                    <td>
                        <a href="{{ url('kategori/edit/' . $kategori->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-cog"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
</body>
</html>