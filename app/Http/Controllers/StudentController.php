<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Laporan;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{

    public function index(Request $request)
    {

        $searchTerm = $request->input('search');
        
        // Ambil data laporan yang diurutkan berdasarkan waktu penambahan terbaru
        $students = Laporan::with('siswa', 'pelapor')->where('pelapor_id', 'LIKE', "%{$searchTerm}%")
        ->orWhere('nama', 'LIKE', "%{$searchTerm}%")
        ->orWhere('pelanggaran', 'LIKE', "%{$searchTerm}%")
        ->orWhere('point', 'LIKE', "%{$searchTerm}%")
        ->orWhere('tanggal', 'LIKE', "%{$searchTerm}%")
        ->orderBy('created_at', 'desc')
        ->paginate(10);
                    // Urutkan berdasarkan waktu penambahan terbaru
    
        return view('listpelanggaran.listpelanggaran', [
            'title' => 'List Pelanggaran Siswa',
            'students' => $students,
        ]);
    }
    


    
     
     
    public function indexdata()
    {
        $studentItem = Student::paginate(3);
        return view('student.datasiswa', [
            'studentItem' => $studentItem,
            'title' => 'Data Siswa'
        ]);
    }


    public function create()
    {
        return view('student.create', ['title' => 'Tambah Data Siswa']);
    }

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
        $studentlist = Student::with('laporan')->findOrFail($id);
        return view('listpelanggaran.showlist', compact('studentlist'));
        
    }
    public function edit(Student $studentItem, $id)
    {
        $studentItem = Student::findOrFail($id);
        return view('student.edit', compact('studentItem'), [
            'title' => 'Edit Data'
        ]);
    }

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

        return redirect()->route('datasiswa')->with('success', 'Data berhasil diubah!');
    }


    public function destroy(Student $studentItem, $id)
    {
        $studentItem = Student::findOrFail($id);
        $studentItem->delete();
        return redirect('datasiswa')->with('success', 'Data berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // search siswa brdasarkn nis
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
         $studentItem = $query->paginate(5);

         return view('student.datasiswa', [
             'title' => 'Data Siswa',
             'studentItem' => $studentItem
         ]);
     }

     public function listDestroy($id)
{
    // Cari data pelanggaran berdasarkan id
    $pelanggaran = Laporan::findOrFail($id);

    // Hapus data pelanggaran
    $pelanggaran->delete();

    // Redirect kembali ke halaman list pelanggaran dengan pesan sukses
    return redirect()->back()->with('success', 'Pelanggaran berhasil dihapus!');
}


    
}