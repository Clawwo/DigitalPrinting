<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Pesanan  {{ $pesanan->nama }}</h2>
        <form action="{{url('/order/edit/proses')}}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Apakah Anda yakin ingin mengubah pesanan ini?')">
            @csrf
            <input type="hidden" name="id" value="{{ $pesanan->id }}">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $pesanan->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $pesanan->email }}" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No. HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $pesanan->no_hp }}" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori" onchange="updateJenisOptions()" required>
                    <option value="">Pilih Kategori Layanan</option>
                    <option value="Printer DTF" {{ $pesanan->kategori == 'Printer DTF' ? 'selected' : '' }}>Printer DTF</option>
                    <option value="Printer Plotter Banner" {{ $pesanan->kategori == 'Printer Plotter Banner' ? 'selected' : '' }}>Printer Plotter Banner</option>
                    <option value="Printer Sublime" {{ $pesanan->kategori == 'Printer Sublime' ? 'selected' : '' }}>Printer Sublime</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis</label>
                <select name="jenis" class="form-select" id="jenis" required>
                    <option value="">Pilih Jenis</option>
                </select>   
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $pesanan->deskripsi }}</textarea>
            </div>
            <div class="mb-3">
                <label for="file_desain" class="form-label">File Desain</label>
                <input type="file" class="form-control" id="file_desain" name="file_desain" value="{{$pesanan->file_desain}}">
            </div>
            <div class="mb-3">
                <label for="estimasiJadi">Estimasi Jadi</label>
                <input name="estimasi_jadi" type="date" class="form-control datetimepicker-input" id="estimasiJadi" value="{{ $pesanan->estimasi_jadi }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
                

                

    <script>
        function updateJenisOptions() {
            var kategori = document.getElementById("kategori").value;
            var jenisSelect = document.getElementById("jenis");
            var selectedJenis = "{{ $pesanan->jenis }}";
            
            // Hapus semua opsi saat ini
            jenisSelect.innerHTML = '<option value="">Pilih Jenis</option>';
            
            var jenisOptions = {
                "Printer DTF": ["Kaos", "Jaket", "Topi", "Tas"],
                "Printer Plotter Banner": ["Frontlite", "Backlite", "Sticker Vinyl", "Sticker Transparan", "Sticker One Way Vision", "Mesh Banner", "Clothe Banner"],
                "Printer Sublime": ["Jersy", "Jilbab", "Taplak Meja", "Selimut", "Sarung"]
            };
            
            if (jenisOptions[kategori]) {
                jenisOptions[kategori].forEach(function(item) {
                    var option = document.createElement("option");
                    option.value = item;
                    option.text = item;
                    if (item === selectedJenis) {
                        option.selected = true;
                    }
                    jenisSelect.add(option);
                });
            }
        }
    
        // Panggil fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            updateJenisOptions();
        });
    
        // Modifikasi untuk tidak mengubah estimasi jadi jika tidak ada input
        document.querySelector('form').addEventListener('submit', function(event) {
            var estimasiJadiInput = document.getElementById('estimasiJadi');
            if (!estimasiJadiInput.value) {
                estimasiJadiInput.setAttribute('disabled', 'disabled'); // Nonaktifkan input jika kosong
            }
        });
    </script>
</body>
</html>