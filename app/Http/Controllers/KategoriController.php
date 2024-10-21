<?php

namespace App\Http\Controllers;

use App\Models\Pasal;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
   
    public function index()
    {
        $kategoris = Kategori::paginate(10);
        $pasal = Pasal::all();
        return view('kategori.kategoripelanggaran', [
        'pasal' => $pasal,
        'kategoris' => $kategoris,
        'title' => 'Kategori Pelanggaran']);
    }
    
   
    public function create()
    {
        $pasal = Pasal::all();
        return view('kategori.create', 
        [
            'pasal' => $pasal,
            'title' => 'Tambah Kategori'
        ]);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'pelanggaran' => 'required|string',
            'point' => 'required|string|max:50',
            'level' => 'required|string|max:200',
            'kode' => 'nullable|string|max:10',
        ]);
    
        $count = Kategori::count();
        $newKode = 'KAT' . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
    
        Kategori::create([
            'pelanggaran' => $request->pelanggaran,
            'point' => $request->point,
            'level' => $request->level,
            'kode' => $newKode
        ]);
    
        return redirect()->back()->with('success', 'Data berhasil ditambahkan dengan kode unik: ' . $newKode);
    }
    
   
    public function edit(Kategori $kategoris, $id)
    {
        $kategoris = Kategori::findOrFail($id);
        $pasals = Pasal::all(); 
        return view('kategori.edit', compact('kategoris', 'pasals'), ['title' => 'Edit Data']);
    }

  
    public function update(Request $request, Kategori $kategori, $id)
    {
        $request->validate([
            'pelanggaran' => 'required',
            'point' => 'required|string|max:200',
            'level' => 'required|string|max:200',
            'kode' => 'nullable|string|max:10',
        ]);
    
        $kategoris = Kategori::find($id);
    
        $count = Kategori::count();
        $newKode = 'KAT' . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
    
        $kategoris->update([
            'pelanggaran' => $request->pelanggaran,
            'point' => $request->point,
            'level' => $request->level,
            'kode' => $newKode
        ]);
    
        return redirect('/kategoripelanggaran')->with('success', 'Data berhasil diubah dengan kode unik baru: ' . $newKode);
    }
    
    public function destroy(Kategori $kategoris, $id)
    {
        $kategoris = Kategori::findOrFail($id);
        $kategoris->delete();
        return redirect('/kategoripelanggaran')->with('success', 'Data berhasil dihapus!');
    }

    
    public function searchkategori(Request $request)
    {
        $query = $request->get('query');
        $pelanggaran = Kategori::where('pelanggaran', 'LIKE', "%{$query}%")
                                ->orWhere('kode', 'LIKE', "%{$query}%")
                                ->get();
    
        return response()->json($pelanggaran);
    }

   
    public function search(Request $request)
    {
        $pasal = Pasal::get();
        $searchTerm = $request->input('search');
        
        $kategoris = Kategori::where('pelanggaran', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('point', 'LIKE', "%{$searchTerm}%")
                        ->orWhereHas('pasal', function($query) use ($searchTerm) {
                            $query->where('level', 'LIKE', "%{$searchTerm}%");
                        })
                        ->paginate(5)
                        ->appends(['search' => $searchTerm]); 
    
        
        $pasal = Pasal::where('level', 'LIKE', "%{$searchTerm}%")
                        ->paginate(5)
                        ->appends(['search' => $searchTerm]); 
        
        return view('kategori.kategoripelanggaran', compact('kategoris', 'pasal', 'searchTerm'), [
            'title' => 'Search Kategori Pelanggaran'
        ]);
    }
    

}
