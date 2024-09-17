<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
   
    public function index()
    {
        $kategori = Kategori::get();
        return view('kategori.kategoripelanggaran', ['kategori' => $kategori, 'title' => 'Kategori Pelanggaran']);
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

   
    public function edit(Kategori $kategori, $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'), ['title' => 'Edit Data']);
    }

  
    public function update(Request $request, Kategori $kategori, $id)
    {
        
        $request->validate([
            'pelanggaran' => 'required|string|max:40',
            'point' => 'required|string|max:50',
            'level' => 'required|string|max:50',
        ]);
    
       
        $kategori = Kategori::find($id);
        $kategori->update([
            'pelanggaran' => $request->pelanggaran,
            'point' => $request->point,
            'level' => $request->level,
        ]);
    
       
        return redirect('/kategoripelanggaran')->with('success', 'Data berhasil diubah!');
    }

   
    public function destroy(Kategori $kategori, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
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
        
      
        $kategori = Kategori::where('pelanggaran', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('point', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('level', 'LIKE', "%{$searchTerm}%")
                    ->get();
        
        return view('kategori.kategoripelanggaran', compact('kategori'), ['title' => 'Search Data']);
    }
}
