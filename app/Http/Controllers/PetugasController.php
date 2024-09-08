<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function tampil(){
        $petugas = Petugas::paginate(5);
        return view('petugas.petug',compact('petugas'),[
            'title' => 'Daftar Petugas'
        ]);
    }

    public function tambah(){
        return view('petugas.tambah',['title' => 'Tambah Data Petugas']);
    }

    public function submit(Request $request){
        $petugas = new Petugas();
        $petugas->nis = $request->nis;
        $petugas->namaP = $request->namaP;
        $petugas->kelas = $request->kelas;
        $petugas->jk = $request->jk;
        $petugas->jurusan = $request->jurusan;
        $petugas->namao = $request->nama_orga;
        $petugas->save();

        return redirect()->route('petugas.tampil');

    }

    public function edit($id){
        $petugas = Petugas::find($id);
        return view('petugas.edit',compact('petugas'),[
            'title' => 'Edit Data Petugas'
        ]);
    }

    public function update(Request $request, $id){
        $petugas = Petugas::find($id);
        $petugas->nis = $request->nis;
        $petugas->namap = $request->nama_petugas;
        $petugas->kelas = $request->kelas;
        $petugas->jurusan = $request->jurusan;
        $petugas->namao = $request->nama_orga;
        $petugas->update();

        return redirect()->route('petugas.tampil');

    }
    public function delete($id){
        $petugas = Petugas::find($id);
        $petugas->delete();

        return redirect()->route('petugas.tampil');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        
        // Mencari kategori berdasarkan nama pelanggaran, point, atau level
        $petugas = Petugas::where('nis', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('namaP', 'LIKE', "%{$searchTerm}")
                    ->orWhere('kelas', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('jurusan', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('namao', 'LIKE', "%{$searchTerm}%")
                    ->paginate();
        return view('petugas.petug', compact('petugas'), [
            'title'=>'Search Data Petugas'

        ]);
    }

}
