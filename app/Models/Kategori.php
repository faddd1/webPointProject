<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'pelanggaran',
        'point',
        'level',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'kategori_id', 'id');
    }
}
