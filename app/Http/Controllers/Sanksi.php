<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Hukuman;
use App\Models\Student;
use Illuminate\Http\Request;

class Sanksi extends Controller
{
    public function sanksi(Request $request)
    {
        $searchTerm = $request->input('search');
    
        $siswa = Student::with('hukuman')
            ->where(function($query) use ($searchTerm) {
                $query->whereHas('hukuman', function($query) use ($searchTerm) {
                    $query->where('nama_hukuman', 'LIKE', "%{$searchTerm}%");
                })
                ->orWhere('nama', 'LIKE', "%{$searchTerm}%")
                ->orWhere('kelas', 'LIKE', "%{$searchTerm}%")
                ->orWhere('jurusan', 'LIKE', "%{$searchTerm}%")
                ->orWhere('nis', 'LIKE', "%{$searchTerm}%")
                ->orWhere('jk', 'LIKE', "%{$searchTerm}%");
            })
            ->paginate(10);
    
        $studentsWithSanctions = collect();
    
        foreach ($siswa as $student) {
            if ($student->point < 0) {
                $hukuman = Hukuman::where('pointAwal', '>=', $student->point)
                    ->where('pointAkhir', '<=', $student->point)
                    ->first();
    
                if ($hukuman) {
                    $student->hukuman = $hukuman;
                    $studentsWithSanctions->push($student); 
                    logger()->info("Student {$student->nama} (Points: {$student->point}) receives: {$hukuman->nama_hukuman}");
                }
            }
        }
    
        if ($studentsWithSanctions->isEmpty()) {
            logger()->info("Tidak ada siswa dengan hukuman.");
        }
    
        return view('hukuman.sanksi.sanksi', [
            'studentsWithSanctions' => $studentsWithSanctions,
            'title' => 'Sanksi Siswa'
        ]);
    }
    
}
