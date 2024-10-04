<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
   
    public function index()
    {
        // $datakategori = Kategori::paginate(5);
        $kategoris = Kategori::paginate(10);
        return view('kategori.kategoripelanggaran', ['kategoris' => $kategoris, 'title' => 'Kategori Pelanggaran']);
    }
    
   
    public function create()
    {
        return view('kategori.create', ['title' => 'Tambah Kategori']);
    }

   
    public function store(Request $request)
    {
       
        $request->validate([
            'pelanggaran' => 'required|string|max:40',
            'point' => 'required|string|max:50',
            'level' => 'required|string|max:50',
        ]);
    
       
        Kategori::create([
            'pelanggaran' => $request->pelanggaran,
            'point' => $request->point,
            'level' => $request->level,
        ]);
        
       
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

   
    public function edit(Kategori $kategoris, $id)
    {
        $kategoris = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategoris'), ['title' => 'Edit Data']);
    }

  
    public function update(Request $request, Kategori $kategori, $id)
    {
        
        $request->validate([
            'pelanggaran' => 'required|string|max:40',
            'point' => 'required|string|max:50',
            'level' => 'required|string|max:50',
        ]);
    
       
        $kategoris = Kategori::find($id);
        $kategoris->update([
            'pelanggaran' => $request->pelanggaran,
            'point' => $request->point,
            'level' => $request->level,
        ]);
    
       
        return redirect('/kategoripelanggaran')->with('success', 'Data berhasil diubah!');
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
        $pelanggaran = Kategori::where('pelanggaran', 'LIKE', "%{$query}%")->get();
    
        return response()->json($pelanggaran);
    }

   
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        
      
        $kategoris = Kategori::where('pelanggaran', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('point', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('level', 'LIKE', "%{$searchTerm}%")
                    ->paginate(4);
        
        return view('kategori.kategoripelanggaran', compact('kategoris'), ['title' => 'Kategori Pelanggaran']);
    }
}
