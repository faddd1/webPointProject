<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Petugas;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin()
    {
        if (Auth::user()->role != 'admin') {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $today = Carbon::today();

        $totalSiswa = Student::count();
        $totalGuru = Teacher::count();
        $totalPetugas = Petugas::count();
        $totalPelanggaran = Kategori::where('pelanggaran', '!=', null)->count();
        $totalUser = User::count();
        $topStudents = Student::orderBy('point', 'asc')->take(4)->get();

   
        $totalPelanggaranHariIni = Laporan::where('status', 'Diterima')
            ->whereDate('created_at', $today)
            ->count();

      
                
            $topPelanggaran = Laporan::select('pelanggaran', \DB::raw('count(*) as jumlah'))
            ->where('status', 'Diterima')
            ->groupBy('pelanggaran')
            ->orderBy('jumlah', 'desc')
            ->limit(5)
            ->get();

                return view('page.dashboard', [
                    'title' => 'Beranda',
                ], compact('totalSiswa','topPelanggaran','totalPelanggaranHariIni', 'totalGuru','topStudents', 'totalPelanggaran', 'totalUser', 'totalPetugas'));

     }
    
    public function guru()
    {
        if (Auth::user()->role != 'guru') {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $today = Carbon::today();

        $topStudents = Student::orderBy('point', 'asc')->take(4)->get();
        
      
        $totalPelanggaranHariIni = Laporan::where('status', 'Diterima')
            ->whereDate('created_at', $today)
            ->count();

       
        $topPelanggaran = Laporan::select('pelanggaran', \DB::raw('count(*) as jumlah'))
            ->where('status', 'Diterima')
            ->groupBy('pelanggaran')
            ->orderBy('jumlah', 'desc')
            ->limit(5)
            ->get();

        return view('page.dashboard', [

            'title' => 'Beranda'
        ], compact('topPelanggaran','totalPelanggaranHariIni','topStudents'));

    }

    public function petugas()
    {
        if (Auth::user()->role != 'petugas') {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $today = Carbon::today();

        $topStudents = Student::orderBy('point', 'asc')->take(4)->get();
        
      
        $totalPelanggaranHariIni = Laporan::where('status', 'Diterima')
            ->whereDate('created_at', $today)
            ->count();

       
        $topPelanggaran = Laporan::select('pelanggaran', \DB::raw('count(*) as jumlah'))
            ->where('status', 'Diterima')
            ->groupBy('pelanggaran')
            ->orderBy('jumlah', 'desc')
            ->limit(5)
            ->get();

        return view('page.dashboard', [
            'title' => 'Beranda'
        ], compact('topPelanggaran','totalPelanggaranHariIni','topStudents'));

    }

    public function siswa()
    {
        if (Auth::user()->role != 'siswa') {
            return redirect('/homepage')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $topStudents = Student::orderBy('point', 'asc')->take(4)->get();

       
        $topPelanggaran = Laporan::select('pelanggaran', \DB::raw('count(*) as jumlah'))
            ->where('status', 'Diterima')
            ->groupBy('pelanggaran')
            ->orderBy('jumlah', 'desc')
            ->limit(5)
            ->get();

        return view('page.dashboard', [
            'title' => 'Beranda'
        ], compact('topPelanggaran','topStudents'));
    }
}
