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

        $request->validate([
            'nis' => 'required|unique:petugas,nis',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:10',
            'jk' => 'required',
            'jurusan' => 'required|string|max:100',
            'namao' => 'required|string|max:255',
        ], [
            'nis.unique' => 'NIS sudah digunakan. Silakan gunakan NIS yang lain.',
        ]);

        Petugas::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jk' => $request->jk,
            'jurusan' => $request->jurusan,
            'namao' => $request->namao,
        ]);
        return redirect()->route('petugas.tampil')->with('success', 'Data berhasil ditambahkan!');
    }

    
    public function edit($id){
        $petugas = Petugas::find($id);
        return view('petugas.edit',compact('petugas'),[
            'title' => 'Edit Data Petugas'
        ]);
    }

  
    public function update(Request $request, $id){

           
       
        $request->validate([
            'nis' => 'required|unique:petugas,nis,'. $id,
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:10',
            'jk' => 'required',
            'jurusan' => 'required|string|max:100',
            'namao' => 'required|string|max:255',
        ], [
            'nis.unique' => 'NIS sudah digunakan. Silakan gunakan NIS yang lain.',
        ]);
        $petugas = Petugas::find($id);
        $petugas->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jk' => $request->jk,
            'jurusan' => $request->jurusan,
            'namao' => $request->namao,
        ]);
        return redirect()->route('petugas.tampil')->with('success', 'Data berhasil diUbah!');

    }

    
    

   
    public function delete($id){
        $petugas = Petugas::find($id);
        $user = User::where('nis', $petugas->nis)->where('role', 'petugas')->first(); 
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
                    ->orWhere('nama', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('kelas', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('jurusan', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('namao', 'LIKE', "%{$searchTerm}%")
                    ->paginate();
                    
        return view('petugas.petug', compact('petugas'), [
            'title'=>'Data Petugas'

        ]);
    }
}
