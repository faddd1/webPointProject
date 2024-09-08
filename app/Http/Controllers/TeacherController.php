<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $teacher = Teacher::paginate(5);
        return view('teacher.dataguru', [
            'teacher' => $teacher,
            'title' => 'Data Guru'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('teacher.create', [
            'title' => 'Tambah Data Guru'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher, $id)
    {
        $teacher = Teacher::findOrFail($id);
        return view ('teacher.edit', compact('teacher'), [
            'title' => 'Edit Data Guru'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
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

        return redirect('teacher');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return redirect('teacher');

    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        
        // Mencari kategori berdasarkan nama pelanggaran, point, atau level
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
