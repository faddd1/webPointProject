<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Student;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::get();
        return view('kategori.kategoripelanggaran', ['kategori' => $kategori, 'title' => 'Kategori Pelanggaran']);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create', ['title' => 'Tambah Kategori']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate ([

            'pelanggaran' => 'required|string|max:40',
            'point' => 'required|string|max:50',
            'level' => 'required|string|max:50',
           ]);
    
           Kategori::create([
    
            'pelanggaran' => $request->pelanggaran,
            'point' => $request->point,
            'level' => $request->level,
           ]);
           return redirect('/kategoripelanggaran');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori, $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'), [
            'title' => 'Edit Data'
        
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori, $id)
    {
        $request -> validate ([
            'pelanggaran' => 'required|string|max:40',
            'point' => 'required|string|max:50',
            'level' => 'required|string|max:50',
            ]);
    
            $kategori = Kategori::find($id);
            $kategori->update ([
                'pelanggaran' => $request->pelanggaran,
                'point' => $request->point,
                'level' => $request->level,
            ]);
    
            return redirect('/kategoripelanggaran');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori, $id)
    {

    $kategori = Kategori::findOrFail($id);
    $kategori->delete();
    return redirect('/kategoripelanggaran');

    }


    public function searchkategori(Request $request)
    {
        $query = $request->input('search');
        // $query = $request->get('query');
        $pelanggaran = Kategori::where('pelanggaran', 'LIKE', "%{$query}%")->get();
    
        return response()->json($pelanggaran);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        
        // Mencari kategori berdasarkan nama pelanggaran, point, atau level
        $kategori = Kategori::where('pelanggaran', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('point', 'LIKE', "%{$searchTerm}")
                    ->orWhere('level', 'LIKE', "%{$searchTerm}%")
                    ->get();
        
        return view('kategori.kategoripelanggaran', compact('kategori'), [
            'title'=>'Search Data'
        ]);
    }

}
