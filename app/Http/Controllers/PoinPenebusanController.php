<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoinPenebusan;

class PoinPenebusanController extends Controller
{
    public function index (){
        $prestasi = PoinPenebusan::get();
        return view ('poinPenebusan.index', [
            'prestasi' => $prestasi,
            'title' => 'Poin Penebusan'
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

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function create (){
        return view ('poinPenebusan.create', [
            'title' => 'Poin Penebusan'
        ]);
    }

    public function edit ($id){
        $prestasi = PoinPenebusan::findOrfail($id);
        return view ('poinPenebusan.edit', compact('prestasi'), [
            'title' => 'Poin Penebusan'
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

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function destroy ($id){
       $prestasi = PoinPenebusan::get();
       $prestasi -> delete();
         return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }
}
