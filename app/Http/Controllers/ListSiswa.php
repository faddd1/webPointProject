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

        return redirect()->back()->with('success', 'Data hukuman berhasil ditambahkan!');
    }

    public function create(){
        return view('hukuman.create');
    }

    public function edit(Hukuman $punismen, $id)
    {
        $punismen = Hukuman::findOrFail($id);
        return view('hukuman.edit', compact('punismen'), ['title' => 'Edit Data']);
    }

    public function update( Request $request,Hukuman $punismen, $id) {
        $request->validate ([
            'nama_hukuman' => 'required',
            'pointAwal' =>'required|integer',
            'pointAkhir' =>'required|integer',
        ]);
        
        $pointAwal = -abs($request->input('pointAwal'));
        $pointAkhir = -abs($request->input('pointAkhir'));

        $punismen = Hukuman::findOrFail($id);

        $punismen->update([
            'nama_hukuman' => $request->input('nama_hukuman'),
            'pointAwal' => $pointAwal,
            'pointAkhir' => $pointAkhir,
        ]);

        return redirect()->back()->with('success', 'Data hukuman berhasil diubah!');
    }

    public function destroy(Hukuman $punismen, $id)
    {
        $punismen = Hukuman::findOrFail($id);
        $punismen->delete();
        return redirect()->route('hukuman')->with('success', 'Data hukuman berhasil dihapus!');
    }

    public function searchHukuman(Request $request)
    {
        $query = $request->get('query');
        $punismen = Hukuman::where('nama_hukuman', 'LIKE', "%{$query}%")->get();
    
        return response()->json($punismen);
    }

   
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        
      
        $punismen = Hukuman::where('nama_hukuman', 'LIKE', "%{$searchTerm}%")
                    ->paginate(4);
        
        return view('hukuman.index', compact('punismen'), ['title' => ' Pencarian Hukuman']);
    }
}
