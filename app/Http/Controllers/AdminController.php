<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Halaman admin, hanya untuk role admin
    function admin()
    {
        if (Auth::user()->role != 'admin') {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('page.dashboard', [
            'title' => 'Dashboard'
        ]);
    }

    // Halaman guru, hanya untuk role guru
    function guru()
    {
        if (Auth::user()->role != 'guru') {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('page.dashboard', [
            'title' => 'Dashboard'
        ]);
    }

    // Halaman petugas, hanya untuk role petugas
    function petugas()
    {
        if (Auth::user()->role != 'petugas') {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('page.dashboard', [
            'title' => 'Dashboard'
        ]);
    }

    // Halaman siswa, hanya untuk role siswa
    function siswa()
    {
        if (Auth::user()->role != 'siswa') {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('page.dashboard', [
            'title' => 'Dashboard'
        ]);
    }
}

?>