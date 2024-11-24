<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
  
    public function index()
    {
        // $teacher = Teacher::paginate(5);
        $teacher = Teacher::orderBy('created_at', 'desc')->paginate(5);

        return view('teacher.dataguru', [
            'teacher' => $teacher,
            'title' => 'Data Guru'
        ]);
    }

   
    public function create()
    {
        return view ('teacher.create', [
            'title' => 'Tambah Data Guru'
        ]);
    }

   
    public function store(Request $request)
    {
        if (User::where('nis', $request->nis)->exists()) {
            return redirect()->back()->withErrors(['nis' => 'NIP sudah digunakan di akun guru,silahkan tambahkan nip yang lain.']);
        }
    
        if (Teacher::where('nis', $request->nis)->exists()) {
            return redirect()->back()->withErrors(['nis' => 'NIP sudah digunakan di tabel Guru.']);
        }
    
        $request->validate([
            'nis' => 'required',
            'namaguru' => 'required',
            'jabatan' => 'required',
            'jk' => 'required',
        ]);
    
        $name = $request->namaguru;
        $nis = $request->nis;
        $password = $request->nis;
    
        $user = User::create([
            'name' => $name,
            'nis' => $nis,
            'password' => bcrypt($password),
            'role' => 'guru',
        ]);
    
        Teacher::create([
            'nis' => $nis,
            'namaguru' => $name,
            'jabatan' => $request->jabatan,
            'jk' => $request->jk,
        ]);
    
        return redirect()->back()->with('success', 'Data Guru berhasil ditambahkan! NIP: ' . $nis . ', Password: ' . $password);
    }
        

   
    public function show(Teacher $teacher)
    {
        
    }

   
    public function edit(Teacher $teacher, $id)
    {
        $teacher = Teacher::findOrFail($id);
        return view ('teacher.edit', compact('teacher'), [
            'title' => 'Edit Data Guru'
        ]);
    }

   
    public function update(Request $request, Teacher $teacher , $id)
    {
        $request -> validate([
            'nis' => 'required|unique:teachers,nis,' . $id,
            'namaguru' => 'required',
            'jabatan' => 'required',
            'jk' => 'required'

        ], [
            'nis.unique' => 'Nip sudah digunakan, silakan pilih yang lain.',

       ]);
        
        $teacher = Teacher::find($id);
        $teacher->update([
            'nis' => $request->nis,
            'namaguru' => $request->namaguru,
            'jabatan' => $request->jabatan,
            'jk' => $request->jk

        ]);

        return redirect('teacher')->with('success', 'Data Guru berhasil diubah!');
    }

   
    public function destroy(Teacher $teacher, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $user = User::where('nis', $teacher->nis)->first();

        if ($user) {
            $user->delete();
        }

        $teacher->delete();


        return redirect('teacher')->with('success', 'Data Guru berhasil dihapus!');

    } 

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        
       
        $teacher = Teacher::where('nis', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('namaguru', 'LIKE', "%{$searchTerm}")
                    ->orWhere('jabatan', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('jk', 'LIKE', "%{$searchTerm}%")
                    ->paginate(5);
        
        return view('teacher.dataguru', compact('teacher'), [
            'title'=>'Search Data Guru'
        ]);
    }
}
