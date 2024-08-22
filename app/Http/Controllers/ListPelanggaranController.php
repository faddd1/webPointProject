<?php
namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class ListPelanggaranController extends Controller
{
    public function index() {

        $pelanggaran = Pelanggaran::get();
        return view('listpelanggaran.listpelanggaran', [
            'pelanggaran' => $pelanggaran,
            'title' => 'List Pelanggaran'
        ]);
    }

    public function store(Request $request, Pelanggaran $pelanggaran)
   {
    $request->validate([
        'nis' => 'required|string|max:20',
        'nama' => 'required|string|max:100',
        'jk' => 'required|string|max:100',
        'kelas' => 'required|string|max:20',
        'point' => 'required|integer',
        'pelapor' => 'required|string|max:100',
        'jenis' => 'required|string|max:100',
        'tanggal' => 'required|date',
        'bukti' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $pelanggaran = new Pelanggaran();
    $pelanggaran->nis = $request->nis;
    $pelanggaran->nama = $request->nama;
    $pelanggaran->jk = $request->jk;
    $pelanggaran->kelas = $request->kelas;
    $pelanggaran->point = $request->point;
    $pelanggaran->pelapor = $request->pelapor;
    $pelanggaran->jenis = $request->jenis;
    $pelanggaran->tanggal = $request->tanggal;

    if ($request->hasFile('bukti')) {
        $file = $request->file('bukti');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/bukti', $filename);
        $pelanggaran->bukti = $filename;
    }

    $pelanggaran->save();

    return redirect('/listpelanggaran')->with('success', 'Data berhasil ditambahkan!');
    }

}
