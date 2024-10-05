<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoinPenebusan extends Model
{
    use HasFactory;

    protected $table = 'poin_penebusan';
    protected $fillable = [
        'nama_Prestasi',
        'point',
        'Tingkat',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    // public function laporan()
    // {
    //     return $this->hasMany(PoinPenebusan::class, 'kategori_id', 'id');
    // }
}
