<?php

namespace App\Models;

use App\Models\User;
use App\Models\Laporan;
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

    public function user(){
        return $this->hasOne(User::class);
    }

    public function laporan(){
        return $this->hasOne(Laporan::class);
    }
}
