<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        $data = User::with('siswa')->paginate(5);
        // $currentPage = $data->currentPage();
        return view ('tambahUser.tambahakun', [
            'data' => $data,
            'title' => 'Tambah Akun'
        ]);
    }

    public function create(){
        return view ('tambahUser.buatakun', [
            'title' => 'Tambah Akun'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nis' => 'required|unique:users,nis,',
            'password' => 'required',
            'role' => 'required',
            'plain_password'
        ], [

            'nis.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
        ]);
    
        User::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'role' => $request->role,
            'password' => Hash::make($request['password']),
            'plain_password' => $request['password'],
        ]);

        // return redirect('/tambah');
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(User $data, $id){

        $data = User::findOrFail($id);
        return view('tambahUser.editakun', compact('data'), [
            
            'title' => 'title'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'nis' => 'required|unique:users,nis,' . $id,
            'password' => 'required',
            'role' => 'required'
        ], [
            'nis.unique' => 'NIS sudah digunakan, silakan pilih yang lain.',
        ]);
    
        $data = User::find($id);
        $data->update([
            'name' => $request->name,
            'nis' => $request->nis,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'plain_password' => $request->password,
        ]);
    
        return redirect('tambah')->with('success', 'Data berhasil diubah');
    }


    public function profil(){
        $data = User::with('siswa')->get();
       return view('profile.profile', [
        'data' => $data,
        'title' => 'Profile'
       ]);
    }

    public function storee(Request $request){

        $request->validate([
            'name'=>'required',
            'role'=>'required'
        ]);
    }

    public function destroy(Request $request, User $data, $id){

        $data = User::findOrFail($id);
        $data->delete();
        return redirect('/tambah');
    }

    public function listsiswa(){
        $laporans = Laporan::with(['pelapor', 'siswa'])->paginate(3);
        return view('listpelanggaran.listpelanggaransiswa', [
            'laporans' => $laporans,
            'title' => 'List Pelanggaran Siswa'
        ]);
    }
    
}
