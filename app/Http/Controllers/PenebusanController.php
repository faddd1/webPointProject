<?php

namespace App\Http\Controllers;

use App\Models\Penebusan;
use App\Models\Student; // Pastikan model ini sudah ada
use Illuminate\Http\Request;
use App\Models\PoinPenebusan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class PenebusanController extends Controller
{
    public function index()
    {
    
        $penebusan = Penebusan::where('nis', Auth::user()->nis)->get();

        return view('penebusan.penebusan', [
            'penebusan' => $penebusan,
            'title' => 'Pemulihan Point'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'nama_Prestasi' => 'required',
            'point' => 'required|integer',
            'tanggal' => 'required|date',
            'bukti' => 'nullable|file',
        ]);
    
        try {
            $siswa = Student::where('nis', $request->nis)->first();
            $pelanggaran = $siswa->pelanggaran()->exists();
    
            $penebusan = new Penebusan();
            $penebusan->nis = $request->nis;
            $penebusan->nama = $request->nama;
            $penebusan->nama_Prestasi = $request->nama_Prestasi;
            $penebusan->point = $request->point;
            $penebusan->tanggal = $request->tanggal;
            $penebusan->pelapor_id = Auth::id();
    
            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $penebusan->bukti = $filename;
            }
    
         
            $penebusan->status = 'pending';
            $penebusan->save();
    
            return redirect()->back()->with('success', 'Pemulihan point berhasil disimpan, menunggu verifikasi.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan Pemulihan point: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan Pemulihan point .');
        }
    }
    

    public function searchPenebusan(Request $request)
    {
        $query = $request->get('query');
        $penebusan = PoinPenebusan::where('nama_Prestasi', 'LIKE', "%{$query}%")->get();
    
        return response()->json($penebusan);
    }

    public function showpenebusan()
    {
        $penebusan = Penebusan::where('status', 'pending')
            ->orderBy('created_at', 'desc') 
            ->get();
    
        return view('penebusan.review', compact('penebusan'), ['title' => 'Review Pemulihan']);
    }
    
    public function terimapenebusan($id)
    {
        $penebusan = Penebusan::find($id);

        if (!$penebusan) {
            return redirect()->route('penebusan.review')->with('error', 'Pemulihan point tidak ditemukan.');
        }

    
        $penebusan->status = 'Diterima';
        $penebusan->save();

        $siswa = Student::where('nis', $penebusan->nis)->first();
        $prestasi = PoinPenebusan::where('nama_Prestasi', $penebusan->nama_Prestasi)->first();

        if ($siswa && $prestasi) {
          
            $siswa->point += $prestasi->point;
    
            $siswa->save();
        }

        return redirect()->route('penebusan.review')->with('success', 'Pemulihan point berhasil disetujui.');
    }

    public function tolakpenebusan($id)
    {
        $penebusan = Penebusan::find($id);

        if (!$penebusan) {
            return redirect()->route('penebusan.review')->with('error', 'Pemulihan point tidak ditemukan.');
        }

        $penebusan->status = 'penebusan Tidak Valid';
        $penebusan->save();

        return redirect()->route('penebusan.review')->with('success', 'Pemulihan point telah ditolak dan dimasukkan ke daftar pelanggaran.');
    }

    
    public function show($id){
        $penebusan = Penebusan::with('siswa')->findOrFail($id);

        return view ('penebusan.showpenebusan', compact('penebusan'));
    }
}