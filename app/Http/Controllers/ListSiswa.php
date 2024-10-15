<?php

namespace App\Http\Controllers;

use App\Models\Hukuman;
use App\Models\Laporan;
use App\Models\Penebusan;
use Illuminate\Http\Request;

class ListSiswa extends Controller
{
    public function listsiswa() {
        $totalPelanggaran = Laporan::where('nis', auth()->user()->nis)->count('pelanggaran');
        $totalPrestasi = Penebusan::where('nis', auth()->user()->nis)->count('nama_Prestasi');
    
        $prestasi = Penebusan::with(['pelapor', 'siswa'])
            ->where('status', 'Diterima')
            ->where('nis', auth()->user()->nis)
            ->paginate(5);
    
        $laporans = Laporan::with(['pelapor', 'siswa'])
            ->where('status', 'Diterima')
            ->where('nis', auth()->user()->nis)
            ->paginate(5);
    
     
        $siswa = auth()->user()->siswa;
        $point = $siswa ? $siswa->point : null;
    
        
        $hukuman = null;
        if ($point !== null) {
            $hukuman = Hukuman::where('pointAwal', '<=', $point)
                ->where('pointAkhir', '>=', $point)
                ->first();
        }
    
        return view('listpelanggaran.listpelanggaransiswa', compact('laporans', 'prestasi', 'totalPelanggaran', 'totalPrestasi', 'hukuman'), [
            'title' => 'List Pelanggaran Siswa'
        ]);
    }
    

    public function index() {
        $punismen = Hukuman::get();
        return view('hukuman.index', [
            'punismen' => $punismen,
            'title' => "Hukuman Siswa"
        ]);
    }
    

    public function store( Request $request) {
        $request->validate ([
            'nama_hukuman' => 'required',
            'pointAwal' =>'required|integer',
            'pointAkhir' =>'required|integer',
        ]);
        $pointAwal = -abs($request->input('pointAwal'));
        $pointAkhir = -abs($request->input('pointAkhir'));

        Hukuman::create([
            'nama_hukuman' => $request->input('nama_hukuman'),
            'pointAwal' => $pointAwal,
            'pointAkhir' => $pointAkhir,
        ]);

        return redirect()->back();
    }

    public function create(){
        return view('hukuman.create');
    }

}
