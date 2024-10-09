<?php

namespace App\Http\Controllers;

use App\Models\Penebusan;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Student;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{

    public function index(Request $request)
    {

        $searchTerm = $request->input('search');

        $students = Laporan::with('siswa', 'pelapor')->where('pelapor_id', 'LIKE', "%{$searchTerm}%")
        ->orWhere('nama', 'LIKE', "%{$searchTerm}%")
        ->orWhere('pelanggaran', 'LIKE', "%{$searchTerm}%")
        ->orWhere('point', 'LIKE', "%{$searchTerm}%")
        ->orWhere('tanggal', 'LIKE', "%{$searchTerm}%")
        ->orderBy('created_at', 'desc')
        ->paginate(10);  

        
        return view('listpelanggaran.listpelanggaran', [
            'title' 
                  => 'List Pelanggaran Siswa',
            'students' => $students,
        ]);

    }
    
    public function prestasi(Request $request)
    {

        $searchTerm = $request->input('search');

        $prestasis = Penebusan::with('siswa')
        ->whereHas('siswa', function($query) use ($searchTerm) {
            $query->where('nama', 'LIKE', "%{$searchTerm}%");})
        ->orWhere('nama', 'LIKE', "%{$searchTerm}%")
        ->orWhere('nama_Prestasi', 'LIKE', "%{$searchTerm}%")
        ->orWhere('point', 'LIKE', "%{$searchTerm}%")
        ->orWhere('tanggal', 'LIKE', "%{$searchTerm}%")
        ->orderBy('created_at', 'desc')
        ->paginate(10); 
    
        return view('prestasi.listprestasi', [
            'title' 
                  => 'List Prestasi Siswa',
            'prestasis' => $prestasis,
        ]);
    }


    
     
     
    public function indexdata()
    {
        $studentItem = Student::paginate(10);
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

        'nis' => 'required|unique:students,nis,',
        'nama' => 'required|string|max:50',
        'kelas' => 'required|string|max:50',
        'jurusan' => 'required|string|max:50',
        'jk' => 'required|string|max:50',
       ], [
        'nis.unique' =>  'nis sudah digunakan, silakan pilih yang lain.',

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


    public function showsiswa($id)
    {
       
        $studentlist = Student::with('pelanggaran' ,'penebusan')->findOrFail($id);  
        return view('student.showsiswa', compact('studentlist'));
        
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
        'nis' => 'required|unique:students,nis,' . $id,
        'nama' => 'required|string|max:50',
        'kelas' => 'required|string|max:50',
        'jurusan' => 'required|string|max:50',
        'jk' => 'required|string|max:50',
        ], [
            'nis.unique' => 'Nis sudah digunakan, silakan pilih yang lain.',

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
    
    $user = User::with('laporan')->where('nis', $studentItem->nis)->where('role', 'siswa')->first();
    if ($user) {
        $user->delete();
    }
    $laporan = Laporan::where('nis', $studentItem->nis)->get(); 
    foreach ($laporan as $data) {
        $data->delete();
    }
    
    $studentItem->delete();

    return redirect()->route('datasiswa')->with('success', 'Data siswa, user, dan laporan berhasil dihapus!');
}


    public function hapusPoint() {
        $pointsiswa = Student::whereNotNull('point')->update(['point' => 0]);

        if ($pointsiswa > 0) {
            return redirect()->back()->with('success', 'Seluruh Point Siswa berhasil dihapus!');
        } else {
            return redirect()->back()->with('success', 'Tidak Ada Point Yang dihapus');
        }
    }
    

    public function search(Request $request)
    {
        $query = $request->input('query');
    
       
        $students = Student::where('nama', 'LIKE', "%{$query}%")
                           ->orWhere('nis', 'LIKE', "%{$query}%")
                           ->get();
    
        return response()->json($students);
     }



     public function searchSiswa(Request $request)
     {
         
         $nama = $request->input('nama');
         $kelas = $request->input('kelas');
         $jurusan = $request->input('jurusan');
     
         
         $query = Student::query();
     
         
         if ($nama) {
             $query->where('nama', 'like', '%' . $nama . '%');
         }
     
        
         if ($kelas) {
             $query->where('kelas', $kelas);
         }
     
        
         if ($jurusan) {
             $query->where('jurusan', $jurusan);
         }
     
        
         $studentItem = $query->paginate(10);

         return view('student.datasiswa', [
             'title' => 'Data Siswa',
             'studentItem' => $studentItem
         ]);
     }

     public function listDestroy($id)
{
    
    $pelanggaran = Laporan::findOrFail($id);

    
    $pelanggaran->delete();

   
    return redirect()->back()->with('success', 'Pelanggaran berhasil dihapus!');
}


    
}