<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pelanggaran;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Halaman admin, hanya untuk role admin
    public function admin()
{
    $totalSiswa = Student::count();
    $totalGuru = Teacher::count();
    $totalPetugas = Petugas::count();
    $totalPelanggaran = Kategori::where('pelanggaran', '!=', null)->count();
    $totalUser = User::count();

    // // Query Top Siswa berdasarkan jumlah pelanggaran terbanyak
    // $topSiswa = Student::withCount('laporan')
    // ->orderBy('laporan_count', 'desc') // Urutkan berdasarkan jumlah laporan terbanyak
    // ->take(5) // Batasi 5 siswa teratas
    // ->get();

    // // Query Top Pelanggaran berdasarkan poin tertinggi
    // $topPelanggaran = Kategori::orderBy('point', 'desc') // Urutkan berdasarkan poin tertinggi
    // ->take(5) // Batasi 5 pelanggaran teratas
    // ->get();

    if (Auth::user()->role != 'admin') {
        return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');

        return view('page.dashboard', [
            'title' => 'Beranda'
        ], compact('totalSiswa', 'totalGuru', 'totalPelanggaran', 'totalUser', 'totalPetugas'));
    }

    return view('page.dashboard', [
        'title' => 'Dashboard',


    ], compact('totalGuru','totalPelanggaran','totalUser','totalSiswa','totalPetugas'));
}


    // Halaman guru, hanya untuk role guru
    public function guru()
    {
        if (Auth::user()->role != 'guru') {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('page.dashboard', [
            'title' => 'Beranda'
        ]);
    }

    // Halaman petugas, hanya untuk role petugas
    public function petugas()
    {
        if (Auth::user()->role != 'petugas') {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('page.dashboard', [
            'title' => 'Beranda'
        ]);
    }

    // Halaman siswa, hanya untuk role siswa
    public function siswa()

    {
        if (Auth::user()->role != 'siswa') {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        return view('page.dashboard', [
            'title' => 'Dashboard',
            'count' => 0,
        ]);
    }

}


