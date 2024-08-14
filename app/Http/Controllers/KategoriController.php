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
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request -> validate ([
            'pelanggaran' => 'required|string|max:40',
            'point' => 'required|string|max:50',
            'level' => 'required|string|max:50',
            ]);
    
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
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect('/kategoripelanggaran');
    }

    public function search(Request $request){
        if($request->has('seacrh')) {
            $student = Student::where('nama','LIKE','%',$request->seacrh,'%')->get();
        } else {
            $student = Student::all();
        }
        return view('page.kategoripelanggaran',['student' => $student]);
    }
}
