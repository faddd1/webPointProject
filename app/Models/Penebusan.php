<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penebusan extends Model
{
    use HasFactory;

    protected $table = '_penebusan';
    protected $fillable = [
        'nis',
        'nama',
        'nama_Prestasi',
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
        return $this->belongsTo(PoinPenebusan::class, 'nama_Prestasi', 'nama_Prestasi');
    }

    public function pelapor()
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }
}
