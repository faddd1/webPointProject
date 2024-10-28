<?php

namespace App\Http\Controllers;

use App\Models\Pasal;
use Illuminate\Http\Request;

class PasalController extends Controller
{
    public function createPasall(){

        $pasal = Pasal::all();
        return view('kategori.pasal.createPasal', [
            'pasal' => $pasal,
            'title' => 'Tambah Pasal'
        ]);
    }

    public function createPasal(Request $request){
        
        $request->validate([
            'level' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'required'
        ]);

        Pasal::create([
            'level' => $request->level,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect('/kategoripelanggaran')->with('success', 'Data pelanggaran berhasil ditambahakan!');
    }

    public function editPasal($id){

        $pasal = Pasal::findOrfail($id);
        return view('kategori.pasal.editPasal',[
            'pasal' => $pasal
        ]);
    }

    public function updatePasal(Request $request,$id){
        $request->validate([
            'level' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'required'
        ]);
        $pasal = Pasal::find($id);
        $pasal->update([
            'level' => $request->level,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect('/kategoripelanggaran')->with('success', 'Data Pelanggaran berhasil diubah!');
        
    }

    public function destroyPasal($id){

        $pasal = Pasal::findOrfail($id);
        $pasal -> delete();

        return redirect('/kategoripelanggaran')->with('success', 'Data Pelanggaran berhasil dihapus!');
    }

}
