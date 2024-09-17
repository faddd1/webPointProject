<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
  
    public function index()

    {
        $teacher = Teacher::paginate(5);
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
        $request -> validate([
            'nis'=> 'required',
            'namaguru' => 'required',
            'jabatan' => 'required',
            'jk' => 'required'

        ]);

        Teacher::create([
            'nis' => $request->nis,
            'namaguru' => $request->namaguru,
            'jabatan' => $request->jabatan,
            'jk' => $request->jk

        ]);

       return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
        
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
            'nis'=> 'required',
            'namaguru' => 'required',
            'jabatan' => 'required',
            'jk' => 'required'

        ]);
        $teacher = Teacher::find($id);
        $teacher->update([
            'nis' => $request->nis,
            'namaguru' => $request->namaguru,
            'jabatan' => $request->jabatan,
            'jk' => $request->jk

        ]);

        return redirect('teacher')->with('success', 'Data berhasil diubah!');
    }

   
    public function destroy(Teacher $teacher, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $user = User::where('nis', $teacher->nis)->first();

        if ($user) {
            $user->delete();
        }

        $teacher->delete();


        return redirect('teacher')->with('success', 'Data berhasil dihapus!');

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
