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

    public function store(Request $request)
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

    Pelanggaran::create([
    
        'nis' => $request->nis,
        'nama' => $request->nama,
        'jk' => $request->jk,
        'kelas' => $request->kelas,
        'point' => $request->point,
        'pelapor' => $request->pelapor,
        'jenis' => $request->jenis,
        'tanggal' => $request->tanggal,
        'bukti' => $request->bukti,
       ]);
       return redirect('/listpelanggaran');

    if ($request->hasFile('bukti')) {
        $file = $request->file('bukti');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/bukti', $filename);
        $pelanggaran->bukti = $filename;

    }

    $pelanggaran->save();

    return redirect('/listpelanggaran')->with('success', 'Data berhasil ditambahkan!');
}

    public function search(Request $request)
    {
        $search = $request->input('search');
        $pelanggaran = Pelanggaran::where('nis', 'LIKE', "%{$search}%")
            ->orWhere('nama', 'LIKE', "%{$search}%")
            ->orWhere('jk', 'LIKE', "%{$search}%")
            ->orWhere('kelas', 'LIKE', "%{$search}%")
            ->orWhere('point', 'LIKE', "%{$search}%")
            ->orWhere('pelapor', 'LIKE', "%{$search}%")
            ->orWhere('tanggal', 'LIKE', "%{$search}%")
            ->orWhere('jenis', 'LIKE', "%{$search}%")
            ->get();
        
        return view('listpelanggaran.listpelanggaran', ['pelanggaran' => $pelanggaran, 'title' => 'List Pelanggaran']);
    
    }

}
