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

    public function siswa()
    {
        return $this->belongsTo(Student::class, 'nis', 'nis');
    }

    public function pelanggaranDetail()
    {
        return $this->belongsTo(kategori::class, 'pelanggaran', 'pelanggaran');
    }

    public function pelapor()
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }
}
