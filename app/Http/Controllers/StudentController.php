<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * 
     * 
     */

     public function index(Request $request)
     {
         // Ambil parameter dari request
         $nama = $request->input('nama');
         $kelas = $request->input('kelas');
         $jurusan = $request->input('jurusan');
     
         // Buat query untuk mendapatkan data siswa
         $query = Student::query();
     
         // Jika ada filter berdasarkan nama
         if ($nama) {
             $query->where('nama', 'like', '%' . $nama . '%');
         }
     
         // Jika ada filter berdasarkan kelas
         if ($kelas) {
             $query->where('kelas', $kelas);
         }
     
         // Jika ada filter berdasarkan jurusan
         if ($jurusan) {
             $query->where('jurusan', $jurusan);
         }
     
         // Jalankan query dan dapatkan data siswa
         $students = $query->get();
     
         // Kembalikan view dengan data siswa
         return view('listpelanggaran.listpelanggaran', [
             'title' => 'List Pelanggaran Siswa',
             'students' => $students
         ]);
     }
     
     
    public function indexdata()
    {
        $studentItem = Student::all();
        return view('student.datasiswa', [
            'studentItem' => $studentItem,
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

       return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Misalnya kamu mendapatkan data berdasarkan ID siswa
        $studentlist = Student::with('laporan')->findOrFail($id);  // pastikan menggunakan model yang benar
        return view('listpelanggaran.showlist', compact('studentlist'));
        
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $studentItem, $id)
    {
        $studentItem = Student::findOrFail($id);
        return view('student.edit', compact('studentItem'), [
            'title' => 'Edit Data'
        
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $studentItem, $id)
    {
        $request -> validate ([
        'nis' => 'required|string|max:40',
        'nama' => 'required|string|max:50',
        'kelas' => 'required|string|max:50',
        'jurusan' => 'required|string|max:50',
        'jk' => 'required|string|max:50',
        ]);

        $studentItem = Student::find($id);
        $studentItem->update ([

            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'jk' => $request->jk,
    
        ]);

        return redirect()->route('datasiswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $studentItem, $id)
    {
        $studentItem = Student::findOrFail($id);
        $studentItem->delete();
        return redirect('datasiswa');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // Cari siswa berdasarkan nama atau NIS
        $students = Student::where('nama', 'LIKE', "%{$query}%")
                           ->orWhere('nis', 'LIKE', "%{$query}%")
                           ->get();
    
        return response()->json($students);
    }

    public function searchSiswa(Request $request)
     {
         // Ambil parameter dari request
         $nama = $request->input('nama');
         $kelas = $request->input('kelas');
         $jurusan = $request->input('jurusan');
     
         // Buat query untuk mendapatkan data siswa
         $query = Student::query();
     
         // Jika ada filter berdasarkan nama
         if ($nama) {
             $query->where('nama', 'like', '%' . $nama . '%');
         }
     
         // Jika ada filter berdasarkan kelas
         if ($kelas) {
             $query->where('kelas', $kelas);
         }
     
         // Jika ada filter berdasarkan jurusan
         if ($jurusan) {
             $query->where('jurusan', $jurusan);
         }
     
         // Jalankan query dan dapatkan data siswa
         $studentItem = $query->get();
     
         // Kembalikan view dengan data siswa
         return view('student.datasiswa', [
             'title' => 'Data Siswa',
             'studentItem' => $studentItem
         ]);
     }

    
}
