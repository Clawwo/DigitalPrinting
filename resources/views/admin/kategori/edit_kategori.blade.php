<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Kategori  {{ $pesanan->nama }}</h2>
        <form action="{{ url('/kategori/edit/proses') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Apakah Anda yakin ingin mengubah pesanan ini?')">
            @csrf
            <input type="hidden" name="id" value="{{ $pesanan->id }}">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $pesanan->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="promosi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="promosi" required>{{ $pesanan->promosi }}</textarea>
            </div>
            <div class="mb-3">
                <label for="file_desain" class="form-label">File Desain</label>
                <input type="file" class="form-control" id="file_desain" name="gambar" value="{{$pesanan->gambar}}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>