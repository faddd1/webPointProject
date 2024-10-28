<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserGuruController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->input('role', 'guru'); 
        $data = User::where('role', $role)->paginate(5);
        
        return view('tambahUserGuru.tambahakun', [
            'data' => $data,
            'title' => 'Akun Guru',
            'selectedRole' => $role 
        ]);
    }
    

    public function create(){
        return view ('tambahUserGuru.buatakun', [

            'title' => 'Tambah Akun Guru'
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
                    $fail('NIP sudah digunakan, silakan pilih NIP yang lain.');
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

    return redirect()->back()->with('success', 'Akun Guru Berhasil di Tambahkan!');
}


    public function edit(User $data, $id){

        $data = User::findOrFail($id);
        return view('tambahUserGuru.editakun', compact('data'), [
            
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
                    $fail('NIP sudah digunakan, silakan pilih NIP yang lain.');
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

    return redirect('/tambahGuru')->with('success', 'Akun Guru Berhasil di Ubah');
}


    public function destroy(Request $request, User $data, $id){

        $data = User::findOrFail($id);
        $data->delete();
        return redirect('/tambahGuru')->with('success', 'Akun Guru Berhasil di Hapus');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $role = $request->input('role', 'guru'); 
    
        $data = User::where('role', $role)
                    ->where(function($query) use ($searchTerm) {
                        $query->where('name', 'LIKE', "%{$searchTerm}%")
                              ->orWhere('nis', 'LIKE', "%{$searchTerm}%");
                    })
                    ->paginate(5);
    
        return view('tambahUserGuru.tambahakun', compact('data'), ['title' => 'Akun Guru']);
    }

        
 }
    
