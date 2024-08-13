<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::get();
        return view('student.datasiswa', [
            'student' => $student,
            'title' => 'Data Siswa'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create', ['title' => 'Tambah Data Siswa']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request -> validate ([

        'nis' => 'required|string|max:40',
        'nama' => 'required|string|max:50',
        'kelas' => 'required|string|max:50',
        'jurusan' => 'required|string|max:50',
        'jk' => 'required|string|max:50',
       ]);

       Student::create([

        'nis' => $request->nis,
        'nama' => $request->nama,
        'kelas' => $request->kelas,
        'jurusan' => $request->jurusan,
        'jk' => $request->jk,

       ]);

       return redirect('student');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('student.edit', compact('student'), [
            'title' => 'Edit Data'
        
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request -> validate ([
        'nis' => 'required|string|max:40',
        'nama' => 'required|string|max:50',
        'kelas' => 'required|string|max:50',
        'jurusan' => 'required|string|max:50',
        'jk' => 'required|string|max:50',
        ]);

        $student->update ([

            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'jk' => $request->jk,
    
        ]);

        return redirect('student');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect('student');
    }
}
