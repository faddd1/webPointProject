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
        'point',
        'user_id'
    ];

    public function akun()
    {
        return $this->belongsTo(User::class);
    }

    public function user() { 
        return $this->hasOne(User::class, 'nis', 'nis');
    }

    public function laporan(){
        return $this->hasMany(Laporan::class, 'pelapor_id',);
    }

    public function pelanggaran()
    {
        return $this->hasMany(Laporan::class, 'nis', 'nis');
    }

    public function status()
    {
        return $this->hasOne(Laporan::class, 'status', 'Diterima');
    }

    public function penebusan()
    {
        return $this->hasMany(Penebusan::class, 'nis', 'nis');
    }


    public function hukuman()
    {
        return $this->hasMany(Hukuman::class, 'id', 'id');
    }
    
}

    
    
    
