<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function tampil(){
        $petugas = Petugas::paginate(10);
        return view('petugas.petug',compact('petugas'),[
            'title' => 'Data Petugas'
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

        return redirect()->route('petugas.tampil')->with('success', 'Data berhasil ditambahkan!');

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
        $petugas->jk = $request->jk;
        $petugas->jurusan = $request->jurusan;
        $petugas->namao = $request->nama_orga;
        $petugas->update();

        return redirect()->route('petugas.tampil')->with('success', 'Data berhasil diubah!');

    }
    public function delete($id){
        $petugas = Petugas::find($id);
        $user = User::where('nis', $petugas->nis)->first();
        if ($user) {
            $user->delete();
        }
        $petugas->delete();

        return redirect()->route('petugas.tampil')->with('success', 'Data berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        
        $petugas = Petugas::where('nis', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('namaP', 'LIKE', "%{$searchTerm}")
                    ->orWhere('kelas', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('jurusan', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('namao', 'LIKE', "%{$searchTerm}%")
                    ->paginate();
        return view('petugas.petug', compact('petugas'), [
            'title'=>'Data Petugas'

        ]);
    }

}
