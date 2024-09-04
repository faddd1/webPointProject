<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    public function index(){
        // Menampilkan halaman login
        return view('login.login');
    }

    public function login(Request $request){
        $request->validate([
            'nis' => 'required',
            'password' => 'required'
        ],[
            'nis.required' => 'NIS Wajib di Isi',
            'password.required' => 'Password Wajib di Isi'
        ]);

        $infoLogin = [
            'nis' => $request->nis,
            'password' => $request->password,
        ];

        if(Auth::attempt($infoLogin)){
            $role = Auth::user()->role;

            // Redirect sesuai role
            switch($role) {
                case 'admin':
                    return redirect('dashboard/admin');
                case 'guru':
                    return redirect('dashboard/guru');
                case 'petugas':
                    return redirect('dashboard/petugas');
                case 'siswa':
                    return redirect('dashboard/siswa');
                default:
                    Auth::logout();
                    return redirect()->back()->withErrors('Role tidak ditemukan.');
            }
        } else {
            return redirect()->back()->withErrors('Username dan Password yang dimasukkan tidak sesuai.');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/'); // Setelah logout, kembali ke homepage
    }
}
