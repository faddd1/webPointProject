<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Student;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $report = Laporan::where('nis', Auth::user()->nis)->get();

        return view('laporan.laporan', [
            'report' => $report,
            'title' => 'Laporan'
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'pelanggaran' => 'required',
            'point' => 'required|integer',
            'tanggal' => 'required|date',
            'bukti' => 'nullable|file',
        ]);

        try {
            // Simpan laporan
            $report = new Laporan();
            $report->nis = $request->nis;
            $report->nama = $request->nama;
            $report->pelanggaran = $request->pelanggaran;
            $report->point = $request->point;
            $report->tanggal = $request->tanggal;
            $report->pelapor_id = Auth::id();

            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $report->bukti = $filename;
            }

            $report->status = 'pending';
            $report->save();

            return redirect()->back()->with('success', 'Laporan berhasil disimpan, menunggu verifikasi.');

        } catch (\Exception $e) {
            Log::error('Gagal menyimpan laporan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan laporan.');
        }
    }

    public function showlaporan()
    {
        $reports = Laporan::where('status', 'pending')->get();
        return view('laporan.reviewlaporan', compact('reports'), ['title' => 'Review Laporan']);
    }

    public function terimalaporan($id)
    {
        $report = Laporan::find($id);

        if (!$report) {
            return redirect()->route('laporan.review')->with('error', 'Laporan tidak ditemukan.');
        }

        $report->status = 'Diterima';
        $report->save();

        $siswa = Student::where('nis', $report->nis)->first();
        $pelanggaran = Kategori::where('pelanggaran', $report->pelanggaran)->first();

        if ($siswa && $pelanggaran) {
            $siswa->point += $pelanggaran->point;
            $siswa->save();
        }

        return redirect()->route('laporan.review')->with('success', 'Laporan berhasil disetujui.');
    }

    public function tolaklaporan($id)
    {
        $report = Laporan::find($id);

        if (!$report) {
            return redirect()->route('laporan.review')->with('error', 'Laporan tidak ditemukan.');
        }

        Log::info('Status sebelum: ' . $report->status);

        $report->status = 'Laporan Tidak Valid';
        $report->save();

        Log::info('Status sesudah: ' . $report->status);

        return redirect()->route('laporan.review')->with('success', 'Laporan telah ditolak.');
    }

    public function show($id){
        $report = Laporan::with('siswa')->findOrFail($id);

        return view ('laporan.showlaporan', compact('report'));
    }

    public function getNotifications()
    {
    
        $nis = Auth::user()->nis;
    

        $notifications = Laporan::where('nis', $nis)
                                ->where('created_at', '>=', now()->subDay())
                                ->get();
    
        
        $count = $notifications->count();

        $title = 'Dashboard Siswa';
    
       
        return view('components.navbar', compact('notifications', 'count'));
    }
}

