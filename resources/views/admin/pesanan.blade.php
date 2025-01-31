    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Pesanan</title>
</head>
@extends('admin.sidebar')
<body>
    @section('content')
    <div class="container mt-4">
        <h2>Daftar Pesanan</h2>
        <form action="{{ url('/pesanan') }}" method="GET" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari berdasarkan nama pemesan" name="search" value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Produk</th>
                    <th>Permintaan</th>
                    <th>Foto Desain</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Estimasi Jadi</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanan as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->no_hp }}</td>
                    <td>{{ $p->jenis }}</td>
                    <td>{{ $p->deskripsi }}</td>
                    <td class="text-center">    
                        @if($p->file_desain)
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#fileDesain_{{ $p->id }}">
                                <i class="fa fa-search"></i> Desain
                            </button>
                    
                            <div class="modal fade" id="fileDesain_{{ $p->id }}" tabindex="-1" aria-labelledby="fileDesainLabel_{{ $p->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="fileDesainLabel_{{ $p->id }}">File Desain</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                                @if($p->file_desain)
                                                    <img src="{{ asset('foto_desain/' . $p->file_desain) }}" alt="User Belum Upload Desain" style="width: 100%">
                                                @else
                                                    <p>File desain belum diupload oleh pembeli/customer.</p>
                                                @endif
                                            </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span>User tidak Upload desain</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_pemesanan)->format('d-m-Y H:i:s') }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->estimasi_jadi)->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ url('order/edit/' . $p->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-cog"></i>
                        </a>
                        <form action="{{ url('order/delete') }}" method="POST" style="display:inline;">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="id" value="{{ $p->id }}">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
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
