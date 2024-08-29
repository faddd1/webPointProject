<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pelanggaran;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Halaman admin, hanya untuk role admin
    public function admin()
    {
        $totalSiswa = Student::count();
        $totalGuru = Teacher::count();
        $totalPelanggaran = Kategori::where('pelanggaran', '!=', null)->count();
        $totalUser = User::count();

        $topPelanggaran = Pelanggaran::select('jenis', Pelanggaran::raw('count(*) as total'))
            ->groupBy('jenis')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $topSiswa = Pelanggaran::select('nama', Pelanggaran::raw('SUM(point) as total_point'))
            ->orderBy('total_point', 'desc')
            ->groupBy('nama')
            ->take(5)
            ->get();

        if (Auth::user()->role != 'admin') {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('page.dashboard', [
            'title' => 'Dashboard'
        ], compact('totalSiswa', 'totalGuru', 'totalPelanggaran', 'totalUser', 'topPelanggaran', 'topSiswa'));
    }

    // Halaman guru, hanya untuk role guru
    public function guru()
    {
        if (Auth::user()->role != 'guru') {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('page.dashboard', [
            'title' => 'Dashboard'
        ]);
    }

    // Halaman petugas, hanya untuk role petugas
    public function petugas()
    {
        if (Auth::user()->role != 'petugas') {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('page.dashboard', [
            'title' => 'Dashboard'
        ]);
    }

    // Halaman siswa, hanya untuk role siswa
    public function siswa()
    {
        if (Auth::user()->role != 'siswa') {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('page.dashboard', [
            'title' => 'Dashboard'
        ]);
    }
}


