<?php

namespace App\Http\Controllers;

use App\Models\Penebusan;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Student;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use App\Exports\StudentExport;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
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

        // $studentItem = Student::paginate(3);
        $studentItem = Student::orderBy('created_at', 'desc')->paginate(5);
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


    public function exportPdf(Request $request){
       
        $jurusan = $request->input('jurusan');
            
        // Check if 'Semua Jurusan' is selected
        if ($jurusan == 'all') {
            // Fetch all students if 'Semua Jurusan' is selected
            $studentItem = Student::all();
        } else {
            // Filter data berdasarkan jurusan yang dipilih
            $studentItem = Student::where('jurusan', $jurusan)->get();
        }
        
        // Check if there are no students for the specified jurusan or all
        if ($studentItem->isEmpty()) {
            return redirect()->back()->with('error', 'Data jurusan tidak ditemukan.'); // Redirect back with error message
        }
    
        // Generate PDF with the filtered or all student data
        $pdf = PDF::loadView('pdf.dataSiswa', compact('studentItem', 'jurusan'));
    
        // Use 'semua' in the filename if 'Semua Jurusan' is selected
        return $pdf->download('data_siswa_jurusan_' . ($jurusan == 'all' ? 'semua' : $jurusan) . '.pdf');
    }


    // public function listPdf(){
    //     $studentItem = Laporan::with('siswa','pelanggaranDetail')->get();
    //     $pdf = Pdf::loadView('pdf.listPelanggaran',['studentItem' => $studentItem]);
    //     return $pdf->download('List-Pelanggaran.pdf');
    // }


    public function listPdf(Request $request)
    {
        // Get the start and end dates from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // If both dates are provided, filter the data by the date range
        if ($startDate && $endDate) {
            $studentItem = Laporan::with('siswa', 'pelanggaranDetail')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();
        } else {
            // If no date range is provided, fetch all data
            $studentItem = Laporan::with('siswa', 'pelanggaranDetail')->get();
        }
        

        if ($studentItem->isEmpty()) {
            // If no data is found, redirect back with an error message
            return redirect()->back()->with('error', 'Tidak ada data yang ditemukan');
        }
        // Load the PDF view with the filtered or all data
        $pdf = Pdf::loadView('pdf.listPelanggaran', ['studentItem' => $studentItem]);
    
        // Return the generated PDF for download
        return $pdf->download('List-Pelanggaran.pdf');
    }


    public function exportExcel(Request $request){
        $jurusan = $request->input('jurusan');

        // Check if 'Semua Jurusan' is selected
        if ($jurusan == 'all') {
            // Fetch all students if 'all' is selected
            $data = Student::all();
        } else {
            // Filter data based on selected jurusan
            $data = Student::where('jurusan', $jurusan)->get();
        }

        // If no data is found, redirect with an error message
        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data untuk jurusan yang dipilih.');
        }

        // Generate Excel file based on the filtered data or all data
        return Excel::download(new StudentExport($jurusan), 'data_siswa_jurusan_' . ($jurusan == 'all' ? 'semua' : $jurusan) . '.xlsx');
    }

    // public function exportExcel(){
    //     return(new StudentExport)->download('Data-Siswa.xlsx');
    //     // return Excel::download(new StudentExport, 'invoices.xlsx');
    // }

    
}