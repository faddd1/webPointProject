<?php

namespace App\Models;

use App\Models\Pasal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function pasal()
    {
        return $this->belongsTo(Pasal::class, 'level', 'id');
    }

}
