<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoinPenebusan;

class PoinPenebusanController extends Controller
{
    public function index (){
        $prestasi = PoinPenebusan::paginate(10);
        return view ('poinPenebusan.index', [
            'prestasi' => $prestasi,
            'title' => 'Kategori Prestasi'
        ]);
    }

    public function store (Request $request){
        $request->validate([
            'nama_Prestasi' => 'required|max:30',
            'point' => 'required|max:30',
            'Tingkat' => 'required|max:30',
        ]);

        PoinPenebusan::create([
            'nama_Prestasi' => $request->nama_Prestasi,
            'point'  => $request->point,
            'Tingkat'  => $request->Tingkat,
        ]);

        return redirect()->back()->with('success', 'Data Prestasi berhasil ditambahkan!');
    }

    public function create (){
        return view ('poinPenebusan.create', [
            'title' => 'Poin Restorasi'
        ]);
    }

    public function edit ($id){
        $prestasi = PoinPenebusan::findOrfail($id);
        return view ('poinPenebusan.edit', compact('prestasi'), [
            'title' => 'Poin Restorasi'
        ]);
    }

    public function update (Request $request, $id){
        $request->validate([
            'nama_Prestasi' => 'required|max:30',
            'point' => 'required|max:30',
            'Tingkat' => 'required|max:30',
        ]);
        $prestasi = PoinPenebusan::find($id);
        $prestasi->update([
            'nama_Prestasi' => $request->nama_Prestasi,
            'point'  => $request->point,
            'Tingkat'  => $request->Tingkat,
        ]);

        return redirect()->back()->with('success', 'Data Prestasi berhasil diubah!');
    }

    public function destroy($id)
    {
        $prestasi = PoinPenebusan::find($id); 
        $prestasi->delete(); 
        return redirect()->back()->with('success', 'Data Prestasi berhasil dihapus!');
    }


    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        
      
        $prestasi = PoinPenebusan::where('nama_prestasi', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('point', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('tingkat', 'LIKE', "%{$searchTerm}%")
                    ->paginate(4);
        
        return view('poinPenebusan.index', compact('prestasi'), ['title' => 'Poin Restorasi']);
    }
}
