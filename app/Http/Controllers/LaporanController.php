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
        $report = laporan::all();
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

            // Set status to pending directly
            $report->status = 'pending';
            $report->save();

            return redirect()->back()->with('success', 'Laporan berhasil disimpan, menunggu verifikasi.');

        } catch (\Exception $e) {
            Log::error('Gagal menyimpan laporan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan laporan.');
        }
    }

    public function showPendingReports()
    {
        $reports = Laporan::where('status', 'pending')->get();
        return view('laporan.reviewlaporan', compact('reports'), ['title' => 'Review Laporan']);
    }

    public function approveReport($id)
    {
        $report = Laporan::find($id);

        if (!$report) {
            return redirect()->route('laporan.review')->with('error', 'Laporan tidak ditemukan.');
        }

        // Set status laporan menjadi 'approved'
        $report->status = 'approved';
        $report->save();

        // Tambahkan poin pelanggaran ke siswa
        $siswa = Student::where('nis', $report->nis)->first();
        $pelanggaran = Kategori::where('pelanggaran', $report->pelanggaran)->first();

        if ($siswa && $pelanggaran) {
            $siswa->point += $pelanggaran->point;
            $siswa->save();
        }

        return redirect()->route('laporan.review')->with('success', 'Laporan berhasil disetujui.');
    }

    public function notApproveReport($id)
    {
        $report = Laporan::find($id);

        if (!$report) {
            return redirect()->route('laporan.review')->with('error', 'Laporan tidak ditemukan.');
        }

        // Log status sebelum perubahan
        Log::info('Status sebelum: ' . $report->status);

        // Set status laporan menjadi 'not approved'
        $report->status = 'not approved';
        $report->save();

        // Log status setelah perubahan
        Log::info('Status sesudah: ' . $report->status);

        return redirect()->route('laporan.review')->with('success', 'Laporan telah ditolak.');
    }

    public function show($id){
        $report = Laporan::with('siswa')->findOrFail($id);

        return view ('laporan.showlaporan', compact('report'));
    }

}

