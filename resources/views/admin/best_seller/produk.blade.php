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
        <h2>Data Produk Best Seller</h2>
        <a href="{{ url('/tambah/produk') }}" class="btn btn-primary mb-3">Tambah Produk</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>deskripsi</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produk as $p)
                <tr>
                    <td><img src="{{ asset('images/' . $p->gambar) }}" alt="Pengguna Belum Upload Desain" style="width: 50%" height="50%"></td>
                    <td>{{ $p->produk }}</td>
                    <td>{{ $p->deskripsi }}</td>
                    <td>
                        <a href="{{ url('/produk/edit/' . $p->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-cog"></i>
                        </a>
                        <form action="{{ url('produk/delete') }}" method="POST" style="display:inline;">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="id" value="{{ $p->id }}">
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