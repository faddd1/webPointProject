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
        $pasals = Pasal::all(); 
        return view('kategori.edit', compact('kategoris', 'pasals'), ['title' => 'Edit Data']);
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

    public function createPasall(){

        $pasal = Pasal::all();
        return view('kategori.pasal.createPasal', [
            'pasal' => $pasal,
            'title' => 'Tambah Pasal'
        ]);
    }

    public function createPasal(Request $request){
        
        $request->validate([
            'level' => 'required'
        ]);

        Pasal::create([
            'level' => $request->level
        ]);

        return redirect('/kategoripelanggaran')->with('success', 'Data berhasil ditambahakan!');
    }

    public function editPasal($id){

        $pasal = Pasal::findOrfail($id);
        return view('kategori.pasal.editPasal',[
            'pasal' => $pasal
        ]);
    }

    public function updatePasal(Request $request,$id){
        $request->validate([
            'level' => 'required'
        ]);
        $pasal = Pasal::find($id);
        $pasal->update([
            'level' => $request->level
        ]);

        return redirect('/kategoripelanggaran')->with('success', 'Data berhasil diubah!');
        
    }

    public function destroyPasal($id){

        $pasal = Pasal::findOrfail($id);
        $pasal -> delete();

        return redirect('/kategoripelanggaran')->with('success', 'Data berhasil dihapus!');
    }


}
