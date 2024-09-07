<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'nama',
        'pelanggaran',
        'tanggal',
        'point',
        'bukti',
        'status'
    ];

    // Jika Anda memiliki relasi dengan model lain, bisa didefinisikan di sini
    // Contoh: Relasi dengan model Siswa
    public function siswa()
    {
        return $this->belongsTo(Student::class, 'nis', 'nis');
    }

    // Contoh: Relasi dengan model Pelanggaran
    public function pelanggaranDetail()
    {
        return $this->belongsTo(kategori::class, 'pelanggaran', 'pelanggaran');
    }

    public function pelapor()
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }
    
}
