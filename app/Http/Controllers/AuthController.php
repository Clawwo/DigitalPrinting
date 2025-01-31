<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if(session()->has('admin')){
            return redirect('/pesanan');
        }
        return view('autentikasi.login');
    }
    public function loginProcess(Request $request)
    {
        $email = htmlspecialchars($request->input('email'));
        $email = ($request->input('email'));
        $password = htmlspecialchars($request->input('password'));
        $password =($request->input('password'));
    
        $admin = Admin::where('email', $email)->first();
        
        if ($admin) {
            if ($admin->email === 'admin@gmail.com') {
                if ($password === $admin->password) {
                    $request->session()->put('admin', true);
                    $request->session()->put('id', $admin->id);
                    return redirect('/pesanan');
                } else {
                    return redirect('/login')->with('error', 'Password yang anda masukan salah');
                }
            } else {
                if (Hash::check($password, $admin->password)) {
                    $request->session()->put('admin', true);
                    $request->session()->put('id', $admin->id);
                    return redirect('/pesanan');
                } else {
                    return redirect('/login')->with('error', 'Password yang anda masukan salah');
                }
            }
        } else {
            return redirect('/login')->with('error', 'Email tidak terdaftar');
        }
    }
    public function register(){
        $admin = Admin::where('id', session('id'))->first();
        if ($admin){
            return view('autentikasi.register', compact('admin'));
        }else{
            return redirect('/login')->with('error', 'Silahkan Login Terlebih Dahulu');
        }
    }
    public function registerProcess(Request $request){
        $nama_admin = htmlspecialchars($request->input ('nama_admin'));
        $email = htmlspecialchars($request->input ('email'));
        $password = htmlspecialchars($request->input ('password'));
        
        $HashedPass = Hash::make($password);
        $admin= new Admin();
        
        
        $admin->email = $email;
        $admin->password = $HashedPass;
        
        $admin->nama_admin = $nama_admin;
        $admin->save();
        return redirect('/data_admin');
    }

    public function tampilAdmin(){
        $sesi = session('admin');
        $adm = session('id');

        if ($sesi){
            $admin = Admin:: where('id',$adm)->first();
            $all_admins = Admin::all();
            return view('admin.data_admin', compact('all_admins','admin'));
        }else{
            return redirect('/login-admin');
        }
    }

    public function deleteAdmin(Request $request){
        $sesi = session('admin');
        if($sesi == true){
            $id = $request->input('id');
            $admin = Admin::where('id',$id)->first();
            if($admin){
                $admin -> delete();
                return redirect('/data_admin')->with('succes','Data Berhasil Dihapus');
            }else{
                return redirect('/data_admin')->with('error','Data Gagal Dihapus');
            }
        }
    }

    public function logout(Request $request){
        $request->session()->forget('admin');
        $request->session()->forget('id');
        return redirect('login');
    }
}
