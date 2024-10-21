<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Student;
use App\Models\Kategori;
use App\Models\Prestasi;
use App\Models\Penebusan;
use Illuminate\Http\Request;
use App\Exports\StudentExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
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
        ->paginate(10)
        ->appends(['search' => $searchTerm]); 

         
        $today = Carbon::today();
        $pelanggaranPerHari = Laporan::select(DB::raw('DATE(created_at) as tanggal'), DB::raw('COUNT(*) as total'))
        ->where('status', 'Diterima')
        ->groupBy(DB::raw('DATE(created_at)'))
        ->paginate(8);



        
        return view('listpelanggaran.listpelanggaran', compact('pelanggaranPerHari',),[
            'title' => 'List Pelanggaran Siswa',
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

       return redirect()->back()->with('success', 'Data Siswa berhasil ditambahkan!');
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

        return redirect()->route('datasiswa')->with('success', 'Data Siswa Berhasil diubah!');
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

    return redirect()->route('datasiswa')->with('success', 'Data Siswa, Akun Siswa, dan Laporan Berhasil dihapus!');
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
                           ->paginate();
    
        return response()->json($students);
     }



     public function searchSiswa(Request $request) {
        $query = $request->query('query');
        $jurusan = $request->query('jurusan');
        $kelas = $request->query('kelas');

        $studentItem = Student::where('nama', 'like', "%{$query}%")
            ->when($jurusan, function ($q) use ($jurusan) {
                return $q->where('jurusan', $jurusan);
            })
            ->when($kelas, function ($q) use ($kelas) {
                return $q->where('kelas', $kelas);
            })
            ->paginate(4);

         return view('student.datasiswa', [
             'title' => 'Search Data Siswa',
             'studentItem' => $studentItem
         ]);
     }

     public function listDestroy($id)
    {
    
    $pelanggaran = Laporan::findOrFail($id);

    
    $pelanggaran->delete();

   
    return redirect()->back()->with('success', 'Pelanggaran berhasil dihapus!');
    }


    // public function exportPdf(Request $request)
    // {
       
    //     $jurusan = $request->input('jurusan');
            
    //     // Check if 'Semua Jurusan' is selected
    //     if ($jurusan == 'all') {
    //         // Fetch all students if 'Semua Jurusan' is selected
    //         $studentItem = Student::all();
    //     } else {
    //         // Filter data berdasarkan jurusan yang dipilih
    //         $studentItem = Student::where('jurusan', $jurusan)->get();
    //     }
        
    //     // Check if there are no students for the specified jurusan or all
    //     if ($studentItem->isEmpty()) {
    //         return redirect()->back()->with('error', 'Data jurusan tidak ditemukan.'); // Redirect back with error message
    //     }
    
    //     // Generate PDF with the filtered or all student data
    //     $pdf = PDF::loadView('pdf.dataSiswa', compact('studentItem', 'jurusan'));
    
    //     // Use 'semua' in the filename if 'Semua Jurusan' is selected
    //     return $pdf->download('data_siswa_jurusan_' . ($jurusan == 'all' ? 'semua' : $jurusan) . '.pdf');
    // }


    public function exportPdf(Request $request)
    {
        $jurusan = $request->input('jurusan');
        $kelas = $request->input('kelas'); // Get the selected class

        // Fetch students based on jurusan and kelas
        $studentQuery = Student::query();

        // Check if 'Semua Jurusan' is selected
        if ($jurusan != 'all') {
            $studentQuery->where('jurusan', $jurusan);
        }

        // Check if 'Semua Kelas' is selected
        if ($kelas != 'all') {
            $studentQuery->where('kelas', $kelas);
        }

        // Execute the query to fetch students
        $studentItem = $studentQuery->get();

        // Check if there are no students for the specified criteria
        if ($studentItem->isEmpty()) {
            return redirect()->back()->with('error', 'Data jurusan dan kelas tidak ditemukan.'); // Redirect back with error message
        }

        // Generate PDF with the filtered or all student data
        $pdf = PDF::loadView('pdf.dataSiswa', compact('studentItem', 'jurusan', 'kelas'));

        // Use 'semua' in the filename if 'Semua Jurusan' or 'Semua Kelas' is selected
        return $pdf->download('data_siswa_jurusan_' . ($jurusan == 'all' ? 'semua' : $jurusan) . '_kelas_' . ($kelas == 'all' ? 'semua' : $kelas) . '.pdf');
    }



    public function listPdf(Request $request)
    {
        // Get the start and end dates from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Adjust the end date to include the entire day
        $adjustedEndDate = \Carbon\Carbon::parse($endDate)->endOfDay();
    
        // Fetch the data based on the date range and exclude 'Menunggu Verifikasi' status
        $studentItem = Laporan::with('siswa', 'pelanggaranDetail')
            ->whereBetween('created_at', [$startDate, $adjustedEndDate])
            ->where('status', 'Diterima') 
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Check if data is found
        if ($studentItem->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data yang ditemukan');
        }
    
        // Load the PDF view with the filtered data
        $pdf = Pdf::loadView('pdf.listPelanggaran', [
            'studentItem' => $studentItem,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
        // Return the generated PDF for download
        return $pdf->download('List-Pelanggaran.pdf');
    }
    



    public function exportExcel(Request $request)
    {
        $jurusan = $request->input('jurusan');
        $kelas = $request->input('kelas'); // Get the selected class

        // Fetch students based on jurusan and kelas
        $studentQuery = Student::query();

        // Check if 'Semua Jurusan' is selected
        if ($jurusan != 'all') {
            $studentQuery->where('jurusan', $jurusan);
        }

        // Check if 'Semua Kelas' is selected
        if ($kelas != 'all') {
            $studentQuery->where('kelas', $kelas);
        }

        // Execute the query to fetch students
        $data = $studentQuery->get();

        // If no data is found, redirect with an error message
        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data untuk jurusan dan kelas yang dipilih.');
        }

        // Generate Excel file based on the filtered data or all data
        return Excel::download(new StudentExport($jurusan, $kelas), 'data_siswa_jurusan_' . ($jurusan == 'all' ? 'semua' : $jurusan) . '_kelas_' . ($kelas == 'all' ? 'semua' : $kelas) . '.xlsx');
    }


    // public function exportExcel(Request $request){
    //     $jurusan = $request->input('jurusan');

    //     // Check if 'Semua Jurusan' is selected
    //     if ($jurusan == 'all') {
    //         // Fetch all students if 'all' is selected
    //         $data = Student::all();
    //     } else {
    //         // Filter data based on selected jurusan
    //         $data = Student::where('jurusan', $jurusan)->get();
    //     }

    //     // If no data is found, redirect with an error message
    //     if ($data->isEmpty()) {
    //         return redirect()->back()->with('error', 'Tidak ada data untuk jurusan yang dipilih.');
    //     }

    //     // Generate Excel file based on the filtered data or all data
    //     return Excel::download(new StudentExport($jurusan), 'data_siswa_jurusan_' . ($jurusan == 'all' ? 'semua' : $jurusan) . '.xlsx');
    // }

   

    
}