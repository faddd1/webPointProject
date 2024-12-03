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
        $report = Laporan::where('nis', Auth::user()->nis)->with('pasal')->get();

        return view('laporan.laporan', [
            'report' => $report,
            'title' => 'Laporan'
        ]);
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'nis' => 'required|exists:laporans,nis',
            'nama' => 'required',
            'pelanggaran' => 'required',
            'point' => 'required|integer',
            'tanggal' => 'required|date',
            'bukti' => 'nullable|file',
        ],[
            'nis.required' => 'Pastikan nama dan nis sudah terisi',
            'pelanggaran.required' => 'Pastikan pelanggaran dan point sudah terisi',
            'tanggal.required' => 'Tanggal Wajib di isi',
            'bukti.required' => 'Bukti Wajib di isi'
        ]);


        $point = -abs($request->input('point'));

        $exists = Laporan::where('nis', $request->nis)
        ->where('pelanggaran', $request->pelanggaran)
        ->whereDate('created_at', now()->toDateString())
        ->exists();
        if ($exists) {
            return redirect()->back()->with(['error' => 'Pelanggaran ini sudah dilaporkan untuk siswa dengan NIS tersebut hari ini.']);
        }
        try {

           
            $report = new Laporan();
            $report->nis = $request->nis;
            $report->nama = $request->nama;
            $report->pelanggaran = $request->pelanggaran;
            $report->point = $point;
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
        $reports = Laporan::where('status', 'pending')
        ->orderBy('created_at', 'desc') 
        ->get();
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
            $siswa->point -= abs($pelanggaran->point);
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

        if ($report->bukti) {
            $filePath = public_path('uploads/' . $report->bukti);
            if (file_exists($filePath)) {
                unlink($filePath); 
            }
        }
    
        $report->status = 'Laporan Tidak Valid';
        $report->save();
    
        return redirect()->route('laporan.review')->with('success', 'Laporan telah ditolak dan foto bukti telah dihapus.');
    
    }
    


    public function show($id){
        $report = Laporan::with('siswa')->findOrFail($id);

        return view ('laporan.showlaporan', compact('report'));
    }
}