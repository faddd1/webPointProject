<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserPetugasController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->input('role', 'petugas'); 
        $data = User::where('role', $role)->paginate(5);
        
        return view('tambahUserPetugas.tambahakun', [
            'data' => $data,
            'title' => 'Tambah Akun Petugas',
            'selectedRole' => $role 
        ]);
    }
    

    public function create(){
        return view ('tambahUserPetugas.buatakun', [
            'title' => 'Tambah Akun'
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'nis' => [
            'required',
            function ($attribute, $value, $fail) use ($request) {
                if (User::where('nis', $value)->where('role', $request->role)->exists()) {
                    $fail('NIS sudah digunakan dalam role ini, silakan pilih NIS lain.');
                }
            }
        ],
        'password' => 'required',
        'role' => 'required',
    ]);
    

    User::create([
        'name' => $request->name,
        'nis' => $request->nis,
        'role' => $request->role,
        'password' => Hash::make($request->password),
        'plain_password' => $request->password,
    ]);

    return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
}


    public function edit(User $data, $id){

        $data = User::findOrFail($id);
        return view('tambahUserPetugas.editakun', compact('data'), [
            
            'title' => 'title'
        ]);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'nis' => [
            'required',
            function ($attribute, $value, $fail) use ($request, $id) {
                if (User::where('nis', $value)
                    ->where('role', $request->role)
                    ->where('id', '!=', $id)  
                    ->exists()) {
                    $fail('NIS sudah digunakan dalam role ini, silakan pilih NIS lain.');
                }
            }
        ],
        'role' => 'required',
        'password' => 'required',
    ]);
    

    $data = User::find($id);
    $data->update([
        'name' => $request->name,
        'nis' => $request->nis,
        'role' => $request->role,
        'password' => Hash::make($request->password),
        'plain_password' => $request->password,
    ]);

    return redirect('tambahPetugas')->with('success', 'Data berhasil diubah');
}

    public function destroy(Request $request, User $data, $id){

        $data = User::findOrFail($id);
        $data->delete();
        return redirect('/tambahPetugas')->with('success', 'Datasiswa Berhasil di Hapus');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $role = $request->input('role', 'petugas'); 
    
        $data = User::where('role', $role)
                    ->where(function($query) use ($searchTerm) {
                        $query->where('name', 'LIKE', "%{$searchTerm}%")
                              ->orWhere('nis', 'LIKE', "%{$searchTerm}%");
                    })
                    ->paginate(5);
    
        return view('tambahUserPetugas.tambahakun', compact('data'), ['title' => 'Akun Petugas']);
    }

        
    }
    
