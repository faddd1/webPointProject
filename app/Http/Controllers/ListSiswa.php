<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sanksi;
use App\Models\Hukuman;
use App\Models\Kategori;
use App\Models\Laporan;
use App\Models\Student;
use App\Models\Penebusan;
use Illuminate\Http\Request;
use App\Exports\SanksiExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ListSiswa extends Controller
{
    public function listsiswa() { 
        $totalPelanggaran = Laporan::where('nis', auth()->user()->nis)->count('pelanggaran');
        $totalPrestasi = Penebusan::where('nis', auth()->user()->nis)->count('nama_Prestasi');
    
        $prestasi = Penebusan::with(['pelapor', 'siswa'])
            ->where('status', 'Diterima')
            ->where('nis', auth()->user()->nis)
            ->paginate(5);
    
        $laporans = Laporan::with(['pelapor', 'siswa'])
            ->where('status', 'Diterima')
            ->where('nis', auth()->user()->nis)
            ->paginate(5);
    
     
        $siswa = auth()->user()->siswa;
        $point = $siswa ? $siswa->point : null;
       
        
        $hukuman = null;
        if ($point !== null) {
            $hukuman = Hukuman::where('pointAwal', '>=', $point)
                ->where('pointAkhir', '<=', $point)
                ->get();
        }
    
        return view('listpelanggaran.listpelanggaransiswa', compact('laporans', 'prestasi', 'totalPelanggaran', 'totalPrestasi', 'hukuman'), [
            'title' => 'List Pelanggaran Siswa'
        ]);
    }
    
    

    public function index() {
        $punismen = Hukuman::with('student')->paginate(10);
        return view('hukuman.index', [
            'punismen' => $punismen,
            'title' => "Kategori Sanksi"
        ]);
    }
    

    public function store(Request $request) {
        $request->validate([
            'nama_hukuman' => 'required',
            'pointAwal' => 'required|integer',
            'pointAkhir' => 'required|integer',

        ]);
    
        $pointAwal = -abs($request->input('pointAwal'));
        $pointAkhir = -abs($request->input('pointAkhir'));

        Hukuman::create([
            'nama_hukuman' => $request->input('nama_hukuman'),
            'pointAwal' => $pointAwal,
            'pointAkhir' => $pointAkhir,
        ]);

        return redirect()->back()->with('success', 'Sanksi berhasil ditambahkan!');
    }

    public function create(){
        $students = Student::whereHas('pelanggaran')->get();
        return view('hukuman.create',compact('students'));
    }

    public function edit(Hukuman $punismen, $id)
    {
        $punismen = Hukuman::findOrFail($id);
        return view('hukuman.edit', compact('punismen'), ['title' => 'Edit Data']);
    }

    public function update( Request $request,Hukuman $punismen, $id) {
        $request->validate ([
            'nama_hukuman' => 'required',
            'pointAwal' =>'required|integer',
            'pointAkhir' =>'required|integer',
        ]);
        
        $pointAwal = -abs($request->input('pointAwal'));
        $pointAkhir = -abs($request->input('pointAkhir'));

        $punismen = Hukuman::findOrFail($id);

        $punismen->update([
            'nama_hukuman' => $request->input('nama_hukuman'),
            'pointAwal' => $pointAwal,
            'pointAkhir' => $pointAkhir,
        ]);

        return redirect()->back()->with('success', 'Sanksi berhasil diubah!');
    }

    public function destroy(Hukuman $punismen, $id)
    {
        $punismen = Hukuman::findOrFail($id);
        $punismen->delete();
        return redirect()->route('hukuman')->with('success', 'Sanksi berhasil dihapus!');
    }
    
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        
      
        $punismen = Hukuman::where('nama_hukuman', 'LIKE', "%{$searchTerm}%")
                    ->paginate(4);
        
        return view('hukuman.index', compact('punismen'), ['title' => ' Pencarian Sanksi']);
    }

   
   
    public function sanksiPdf(Request $request)
    {
        // Validate request
        $request->validate([
            'jurusan' => 'sometimes|string',
            'kelas' => 'sometimes|string',
        ]);
    
        // Retrieve jurusan and kelas from the request
        $jurusan = $request->input('jurusan', 'All');
        $kelas = $request->input('kelas', 'All');
    
        // Initialize the query to get students
        $studentQuery = Student::with('hukuman'); // Adjust based on your fields
    
        // Apply filters based on jurusan and kelas only if they are not 'All'
        if ($jurusan !== 'All') {
            $studentQuery->where('jurusan', $jurusan);
        }
        if ($kelas !== 'All') {
            $studentQuery->where('kelas', $kelas);
        }
    
        // Get students from query
        $students = $studentQuery->get();
    
        $studentsWithSanctions = collect();
    
        // Calculate hukuman for each student based on their points
        foreach ($students as $student) {
            if ($student->point < 0) {
                $hukuman = Hukuman::where('pointAwal', '>=', $student->point) 
                    ->where('pointAkhir', '<=', $student->point)               
                    ->first();
        
                if ($hukuman) {
                    $student->hukuman = $hukuman; // Assign the found hukuman
                    $studentsWithSanctions->push($student);
                } else {
                    $student->hukuman = 'No hukuman';
                    $studentsWithSanctions->push($student);
                }
            }
        }
        
    
        // Check if there is any data
        if ($studentsWithSanctions->isEmpty()) {
            return back()->with('error', 'Tidak ada data untuk jurusan dan kelas yang anda pilih.');
        }
    
        // Generate PDF using the Blade view for the table
        $pdf = PDF::loadView('pdf.sanksi', [
            'students' => $studentsWithSanctions,
            'jurusan' => $jurusan,
            'kelas' => $kelas,
        ]);
    
        // Create dynamic filename
        $filename = 'data_sanksi_' . ($jurusan === 'All' ? 'semua_jurusan' : 'jurusan_' . strtolower($jurusan)) . '_' . ($kelas === 'All' ? 'semua_kelas' : 'kelas_' . strtolower($kelas)) . '.pdf';
    
        return $pdf->download($filename);
    }

}
