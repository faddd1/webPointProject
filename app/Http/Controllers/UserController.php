<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Student;
use App\Models\Penebusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $role = $request->input('role', 'admin'); 
        $data = User::where('role', $role)->paginate(5);
        
        return view('tambahUserAdmin.tambahakun', [
            'data' => $data,
            'title' => 'Akun Admin',
            'selectedRole' => $role 
        ]);
    }
    

    public function create(){
        return view ('tambahUserAdmin.buatakun', [
            'title' => 'Tambah Akun Admin'
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
                    $fail(' Admin Id sudah digunakan, silakan pilih Admin Id yang lain.');
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

    return redirect()->back()->with('success', 'Akun Admin Berhasil di Tambahkan!');
}


    public function edit(User $data, $id){

        $data = User::findOrFail($id);
        return view('tambahUserAdmin.editakun', compact('data'), [
            
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
                    $fail('Admin Id sudah digunakan, silakan pilih Admin Id lain.');
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

    return redirect('tambah')->with('success', 'Akun Admin Berhasil di Ubah');
}

    public function profil() {
        $data = User::with(['siswa', 'guru'])->where('nis', auth()->user()->nis)->first();
    
        return view('profile.profile', [
            'data' => $data,
            'title' => 'Profil'
        ]);
    }
    

    public function destroy(Request $request, User $data, $id){

        $data = User::findOrFail($id);
        $data->delete();
        return redirect('/tambah')->with('success', 'Akun Admin Berhasil di Hapus');
    }

       
        public function search(Request $request)
        {
            $searchTerm = $request->input('search');
            $role = $request->input('role', 'admin'); 
        
            $data = User::where('role', $role)
                        ->where(function($query) use ($searchTerm) {
                            $query->where('name', 'LIKE', "%{$searchTerm}%")
                                  ->orWhere('nis', 'LIKE', "%{$searchTerm}%");
                        })
                        ->paginate(5);
        
            return view('tambahUserAdmin.tambahakun', compact('data'), ['title' => 'Akun Petugas']);
        }
        
    }
    
