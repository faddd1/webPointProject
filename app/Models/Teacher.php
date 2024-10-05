<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';
    protected $fillable = [
        'nis',
        'namaguru',
        'jabatan',
        'jk'
    ];
    public function pelanggaran()
    {
        return $this->hasMany(Laporan::class, 'nis', 'nis');
    }
}
