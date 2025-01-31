<!DOCTYPE HTML>
<!--
	Solid State by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>K-TUBA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="{{asset("assets/css/main.css")}}">
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<style>
			/* Menghapus panah dari input tipe number */
			input[type=number] {
				-moz-appearance: textfield; /* Untuk Firefox */
			}
			
			input[type=number]::-webkit-inner-spin-button,
			input[type=number]::-webkit-outer-spin-button {
				-webkit-appearance: none;
				margin: 0;
			}
		</style>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<h1>K_TUBA</h1>
						<nav>
							<a href="#menu">Menu</a>
						</nav>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<div class="inner">
							<h2>Menu</h2>
							<ul class="links">
								<li><a href="#">Home</a></li>
								<li><a href="#pemesanan">Pemesanan</a></li>
								<li><a href="https://wa.wizard.id/f5118c">Hubungi Kami</a></li>
							</ul>
							<a href="#" class="close">Close</a>
						</div>
					</nav>

				<!-- Banner -->
					<section id="banner">
						<div class="inner">
							<div class="logo"><img src="{{ asset('images/logo.png') }}" alt="logo" width="150" height="150"></div>
							<h2 style="font-size: 3em">K_TUBA DIGITAL PRINTING</h2>
							<p>Temukan layanan cetak terbaik yang kami tawarkan dan nikmati kualitas serta harga yang bersaing!</p>
						</div>
					</section>

				<!-- Wrapper -->
					<section id="wrapper">

						<!-- One -->
							<section id="one" class="wrapper spotlight style1">
								<div class="inner">
									@if($kategori)
										@if($kategori->gambar)
											<img src="{{ asset('images/' . $kategori->gambar) }}" class="image" alt="{{ $kategori->nama }}">
										@else
											<img src="{{ asset('not_found.jpeg') }}" class="image" alt="{{ $kategori->nama }}">
										@endif
										<div class="content">
											<h2 class="major">{{ $kategori->nama }}</h2>
											<p>{{ $kategori->promosi }}</p>
										</div>
									@else
										<p>Kategori tidak ditemukan.</p>
									@endif
								</div>
							</section>

						<!-- Two -->
							<section id="two" class="wrapper alt spotlight style2">
								<div class="inner">
									@if($ktgr)
										@if($ktgr->gambar)
											<img src="{{ asset('images/' . $ktgr->gambar) }}" class="image" alt="{{ $ktgr->nama }}">
										@else
											<img src="{{ asset('not_found.jpeg') }}" class="image" alt="{{ $ktgr->nama }}">
										@endif
										<div class="content">
											<h2 class="major">{{ $ktgr->nama }}</h2>
											<p>{{ $ktgr->promosi }}</p>
										</div>
									@else
										<p>Kategori tidak ditemukan.</p>
									@endif
								</div>
							</section>

						<!-- Three -->
							<section id="three" class="wrapper spotlight style3">
								<div class="inner">
									@if($ktg)
										@if($ktg->gambar)
											<img src="{{ asset('images/' . $ktg->gambar) }}" class="image" alt="{{ $ktg->nama }}">
										@else
											<img src="{{ asset('not_found.jpeg') }}" class="image" alt="{{ $ktg->nama }}">
										@endif
										<div class="content">
											<h2 class="major">{{ $ktg->nama }}</h2>
											<p>{{ $ktg->promosi }}</p>
										</div>
									@else
										<p>Kategori tidak ditemukan.</p>
									@endif
								</div>
							</section>

						<!-- Four -->
							<section id="four" class="wrapper alt style1">
								<div class="inner">
									<h2 class="major">Produk Best Seller Kami!</h2>
									<p>Temukan produk-produk unggulan kami yang telah terbukti menjadi favorit pelanggan. Setiap produk dirancang dengan kualitas terbaik dan harga yang bersaing. Jangan lewatkan kesempatan untuk mendapatkan produk berkualitas tinggi dari kami!</p>
									<section class="features">
										@foreach ($produk as $p)
										<article>
											<img src="{{ asset('images/' . $p->gambar) }}" alt="gambar" class="image" />
											<h3 class="major">{{ $p->produk }}</h3>
											<p>{{ $p->deskripsi }}</p>
										</article>
										@endforeach
									</section>
								</div>
							</section>

					</section>

				<!-- Footer -->
					<section id="footer">
						<div class="inner">
							<h2 class="major" id="pemesanan">Pesan Layanan Kami</h2>
							<form method="post" action="{{ url('/pesan/proses') }}" enctype="multipart/form-data">
								@csrf
								<div class="fields">
									<div class="field">
										<label for="name">Nama Lengkap</label>
										<input type="text" name="nama" id="name" required/>
									</div>
									<div class="field">
										<label for="email">Email</label>
										<input type="email" name="email" id="email" required />
									</div>
									<div class="field">
										<label for="no_hp">Nomer HP</label>
										<input type="number" name="no_hp" id="no_hp" required />
									</div>
									<div class="field">
										<label for="kategori">Kategori Layanan</label>
										<select name="kategori" class="form-select" id="select1" onchange="updateJenisOptions()" required>
											<option value="">Pilih Kategori Layanan</option>
											<option value="Printer DTF">Printer DTF</option>
											<option value="Printer Plotter Banner">Printer Plotter Banner</option>
											<option value="Printer Sublime">Printer Sublime</option>
										  </select>
									</div>
									<div class="field">
										<label for="jeni">Jenis Layanan</label>
										<select name="jenis" class="form-select" id="select2" required>
											<option value="">Pilih Jenis</option>
										</select>   
									</div>
									<div class="field">
										<label for="message">Permintaan</label>
										<textarea name="deskripsi" id="deskripsi" rows="4" required></textarea>
									</div>
									<div class="field">
										<div class="form-group">
											<label for="designImage" class="form-label">Unggah Desain Anda <span style="color : rgba(231, 79, 79, 10)">(TYPE FILE WAJIB JPG / PNG!!!)</span></label>
											<input name="file_desain" class="form-control" type="file" id="designImage" accept="image/*" >
										</div>
									</div>
									<div class="field">
										<div class="form-floating date" id="date3" data-target-input="nearest">
											<label for="estimasiJadi">Waktu jadi yang anda inginkan</label>
											<input name="estimasi_jadi" type="date" class="form-control datetimepicker-input" id="estimasiJadi" required/>
										</div>
									</div> 
								</div>
								<ul class="actions">
									<li><button type="submit">Pesan</button></li>
								</ul>
							</form>
							<ul class="contact">
								<li class="icon solid fa-home">
								<a href = "https://maps.app.goo.gl/bqm4893n3Gb874Zk6">
									Jl. Parangtritis km 11 Sabdodadi, Bantul 55715, Yogyakarta
								</a>
								</li>
								<li class="icon solid fa-envelope"><a href="mailto:ktubajogja@gmail.com?subject=Pertanyaan&body=Halo, saya ingin bertanya tentang...">ktubajogja@gmail.com</a></li>
								<li class="icon brands fa-instagram"><a href="https://www.instagram.com/ktubadigital?igsh=MTMzZ2lrZ29tN24yeQ==">instagram.com/untitled-tld</a></li>
								<li class="icon brands fa-whatsapp"><a href="https://wa.wizard.id/f5118c">+62 851 9124 1410</a></li>
							</ul>
							<ul class="copyright">
								<li>&copy; Untitled Inc. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>
					</section>

			</div>

			<script>
				function updateJenisOptions() {
					var kategori = document.getElementById("select1").value;
					var jenisSelect = document.getElementById("select2");
					
					// Hapus semua opsi saat ini
					jenisSelect.innerHTML = '<option value="">Pilih Jenis</option>';
					
					if (kategori === "Printer DTF") {
						var jenis = ["Kaos", "Jaket", "Topi", "Tas"];
						jenis.forEach(function(item) {
							var option = document.createElement("option");
							option.value = item;
							option.text = item;
							jenisSelect.add(option);
						});
					} else if (kategori === "Printer Plotter Banner") {
						var jenis = ["Frontlite", "Backlite", "Sticker Vinyl", "Sticker Transparan","Sticker One Way Vision","Mesh Banner","Clothe Banner"];
						jenis.forEach(function(item) {
							var option = document.createElement("option");
							option.value = item;
							option.text = item;
							jenisSelect.add(option);
						});
					} else if (kategori === "Printer Sublime") {
						var jenis = ["Jersy", "Jilbab", "Taplak Meja","Selimut","Sarung"];
						jenis.forEach(function(item) {
							var option = document.createElement("option");
							option.value = item;
							option.text = item;
							jenisSelect.add(option);
						});
					}
				}
			</script>
			<script>
				// Fungsi untuk menampilkan pop-up
				function showSuccessPopup() {
					alert('Pesanan Anda berhasil dibuat! tunggu konfirmasi dari admin kami');
				}
			
				// Cek apakah ada pesan sukses dari server
				@if(session('success'))
					showSuccessPopup();
				@endif
			</script>


		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>