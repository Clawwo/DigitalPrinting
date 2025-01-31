<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Order;
use App\Models\Kategori;
use App\Models\Admin;
use App\Models\Produk;
use Laravel\Prompts\Prompt;

class HomeController extends Controller
{
    public function index()
    {
        $kategori = Kategori::find(1);
        $ktgr = Kategori::find(2);
        $ktg = Kategori::find(3);
        $produk = Produk::all();
        return view('index', compact('kategori','ktgr','ktg','produk'));
    }
    function pesanProses(Request $request)
    {
        $nama = $request->input('nama');
        $email = $request->input('email');
        $no_hp = $request->input('no_hp');
        $kategori = $request->input('kategori');
        $jenis = $request->input('jenis');
        $deskripsi = $request->input('deskripsi');
        $file_desain = $request->file('file_desain');
           if ($file_desain) {
            $thumb = $file_desain->getClientOriginalName();
            $path = public_path(). '/foto_desain';
            
            if(!File::exists($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            $file_desain->move($path, $thumb);
        } else {
            $thumb = null;
        }
        
        $estimasi_jadi = $request->input('estimasi_jadi');
        
        $pesan = new Order;
        $pesan->nama = $nama;
        $pesan->email = $email;
        $pesan->no_hp = $no_hp;
        $pesan->kategori = $kategori;
        $pesan->jenis = $jenis;
        $pesan->deskripsi = $deskripsi;
        $pesan->file_desain = $thumb;
        $pesan->estimasi_jadi = $estimasi_jadi;
        $pesan->tanggal_pemesanan = now();
        $pesan->save();
        if ($pesan) {
            return redirect('/')->with('success', 'Pesanan berhasil dibuat');
        } else {
            return redirect('/')->with('error', 'Pesanan gagal dibuat');
        }
    }

    public function tampilPesanan(Request $request){
        $sesi = session('admin');
        $adm = session('id');
        if ($sesi == true){
            $pesanan = Order::all();
            $admin = Admin::where('id', $adm)->first();
            $search = $request->input('search');
        
            $pesanan = Order::when($search, function ($query) use ($search) {
                return $query->where('nama', 'like', '%' . $search . '%');
            })->get();

            return view('admin.pesanan', compact('pesanan', 'admin'));
        }else{
            return redirect('/login')->with('error', 'Silahkan Login Terlebih Dahulu');
        }
    }

    public function deleteOrder(Request $request){
        $sesi = session ('admin');   
        if ($sesi == true){
            $id = $request->input('id');
            $order = Order::where('id',$id)->first();
            $path = public_path() . '/foto_desain';
            $foto = $order->file_desain;
            if($order){
                $order->delete();
                File::delete($path .'/' . $foto);
                return redirect('/pesanan')->with('success','Data berhasil dihapus');
            }else{
                return redirect('/pesanan')->with('error', 'Data gagal dihapus');
            }

        }else{
            return redirect('/login')->with('error', 'Silahkan login dulu');
        }
        
    }
    public function editPesanan($id){
        $sesi = session('admin');
        $ad_min = session('id');

        if($sesi == true){
            $admin = Admin::where('id', $ad_min)->first();
            $pesanan = Order::where('id', $id)->first();
            return view('admin.edit_pesanan', compact('pesanan', 'admin'));
        }else{
            return redirect('/login')->with('error', 'Silahkan Login Terlebih Dahulu');
        }
    }

    function editPesananProses(Request $request){
        $id = $request->input('id');
        $nama = $request->input('nama');
        $email = $request->input('email');
        $no_hp = $request->input('no_hp');
        $kategori = $request->input('kategori');
        $jenis = $request->input('jenis');
        $deskripsi = $request->input('deskripsi');
        $file_desain = $request->file('file_desain'); // Ambil file desain
        $estimasi_jadi = $request->input('estimasi_jadi');

        $query = Order::where('id', $id)->first();

        if (!$query) {
            return redirect('/pesanan')->with('error', 'Pesanan tidak ditemukan');
        }

        $path = public_path(). '/foto_desain';

        // Cek jika ada file desain yang diunggah
        if ($file_desain) {
            $thumb = $file_desain->getClientOriginalName();
            if ($query->file_desain) {
                File::delete($path . '/' . $query->file_desain);
            }
            $file_desain->move($path, $thumb);
            $query->file_desain = $thumb; // Simpan nama file desain baru
        }

        // Update data lainnya
        $query->nama = $nama;
        $query->email = $email;
        $query->no_hp = $no_hp;
        $query->kategori = $kategori;
        $query->jenis = $jenis;
        $query->deskripsi = $deskripsi;

        if ($estimasi_jadi) {
            $query->estimasi_jadi = $estimasi_jadi;
        }

        $query->save();

        if ($query) {
            return redirect('/pesanan')->with('success', 'Pesanan berhasil diubah');
        } else {
            return redirect('/pesanan')->with('error', 'Pesanan gagal diubah');
        }
    }

    public function kategori(){
        $sesi = session('admin');
        $adm = session('id');

        if($sesi == true){
            $kategori = Kategori::all();
            $admin = Admin::where('id', $adm)->first();
            return view ('admin.kategori.kategori', compact('kategori','admin'));
        }else{
            return redirect('/login',)->with('error', 'Silahkan Login Terlebih Dahulu');
        }
    }

    public function editKategori($id){
        $sesi= session('admin');
        $adm = session('id');
        if($sesi == true){
            $admin = Admin::where('id', $adm)->first();
            $pesanan = Kategori::where('id', $id)->first();
            return view('admin.kategori.edit_kategori', compact('pesanan', 'admin'));
        }else{
            return redirect('/login')->with('error', 'Silahkan Login Terlebih Dahulu');
        }
    }

    function editKategoriProses(Request $request){
        $id = $request->input('id');
        $nama = $request->input('nama');
        $deskripsi = $request->input('promosi');
        $file_desain = $request->file('gambar');
    
        $query = Kategori::where('id', $id)->first();
    
        if (!$query) {
            return redirect('/pesanan')->with('error', 'Pesanan tidak ditemukan');
        }
    
        $path = public_path(). '/images';
    
        if ($file_desain){
            $thumb = $file_desain->getClientOriginalName();
            if ($query->gambar) {
                File::delete($path . '/' . $query->gambar);
            }
            $file_desain->move($path, $thumb);
            $query->gambar = $thumb;
        }
    
        $query->nama = $nama;
        $query->promosi = $deskripsi;

        $query->save();
    
        if($query){
            return redirect('/kategori')->with('success', 'Kategori berhasil diubah');
        }else{
            return redirect('/kategori')->with('error', 'Kategori gagal diubah');
        }
    }

    public function produk(){
        $sesi = session('admin');
        $adm = session('id');
        if($sesi == true){
            $produk = Produk::all();
            $admin = Admin::where('id', $adm)->first();
            return view ('admin.best_seller.produk', compact('produk','admin'));
        }else{
            return redirect('/login',)->with('error', 'Silahkan Login Terlebih Dahulu');
        }
    }

    public function tambahProduk(){
        $sesi = session('admin');
        $adm = session('id');

        if($sesi == true){
            $admin = Admin::where('id', $adm)->first();
            return view ('admin.best_seller.tambah_produk', compact('admin'));
        }else{
            return redirect('/login',)->with('error', 'Silahkan Login Terlebih Dahulu');
        }
    }

    function tambahProdukProses(Request $request){
        $id = $request->input('id');
        $nama_produk = $request->input('produk');
        $deskripsi = $request->input('deskripsi');
        $gambar = $request->file('gambar');
        $thumb = $gambar->getClientOriginalName();
        $path = public_path(). '/images';
        
        if(!File::exists($path)){
            File::makeDirectory($path, 0777, true, true);
            $gambar->move($path, $thumb);
        }else{
            $gambar->move($path, $thumb);
        }

        $produk = new Produk;
        $produk->id = $id;
        $produk->gambar = $thumb;
        $produk->produk = $nama_produk;
        $produk->deskripsi = $deskripsi;
        $produk->save();

        if($produk){
            return redirect('/produk')->with('success', 'Produk Best Seller berhasil dibuat');
        } else {
            return redirect('/produk')->with('error', 'Produk gagal dibuat');
        }
    }

    public function editProduk($id){
        $sesi= session('admin');
        $adm = session('id');
        if($sesi == true){
            $admin = Admin::where('id', $adm)->first();
            $produk = Produk::where('id', $id)->first();
            return view('admin.best_seller.edit_produk', compact('produk', 'admin'));
        }else{
            return redirect('/login')->with('error', 'Silahkan Login Terlebih Dahulu');
        }
    }

    function editProdukProses(Request $request){
        $id = $request->input('id');
        $nama = $request->input('produk');
        $deskripsi = $request->input('deskripsi');
        $file_desain = $request->file('gambar');
    
        $query = Produk::where('id', $id)->first();
    
        if (!$query) {
            return redirect('/produk')->with('error', 'Pesanan tidak ditemukan');
        }
    
        $path = public_path(). '/images';
    
        if ($file_desain){
            $thumb = $file_desain->getClientOriginalName();
            if ($query->gambar) {
                File::delete($path . '/' . $query->gambar);
            }
            $file_desain->move($path, $thumb);
            $query->gambar = $thumb;
        }
    
        $query->produk = $nama;
        $query->deskripsi = $deskripsi;

        $query->save();
    
        if($query){
            return redirect('/produk')->with('success', 'Kategori berhasil diubah');
        }else{
            return redirect('/produk')->with('error', 'Kategori gagal diubah');
        }
    }

    public function deleteProduk(Request $request){
        $sesi = session ('admin');   
        if ($sesi == true){
            $id = $request->input('id');
            $produk = Produk::where('id',$id)->first();
            $path = public_path() . '/images';
            $foto = $produk->gambar;
            if($produk){
                $produk->delete();
                File::delete($path .'/' . $foto);
                return redirect('/produk')->with('success','Data berhasil dihapus');
            }else{
                return redirect('/produk')->with('error', 'Data gagal dihapus');
            }

        }else{
            return redirect('/login')->with('error', 'Silahkan login dulu');
        }
    }
}
