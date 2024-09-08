<?php

namespace App\Models;

use App\Models\User;
use App\Models\Laporan;
use App\Models\Petugas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'jurusan',
        'jk',
        'point'
    ];

    public function user() { 
        return $this->hasOne(User::class, 'nis', 'nis', 'name');
    }

    public function laporan(){
        return $this->hasMany(Laporan::class, 'pelapor_id', );
    }


    public function laporans() {
        return $this->hasMany(Laporan::class, 'student_id'); // Ensure this matches the foreign key in `laporans` table
    }

    public function pelanggaran()
    {
        return $this->hasMany(Laporan::class, 'nis', 'nis');
    }

    public function petugas() {
        return $this->hasOne(Petugas::class, 'nis', 'nis');
    }
    

}
