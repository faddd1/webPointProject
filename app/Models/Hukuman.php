<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hukuman extends Model
{
    use HasFactory;

    protected $table= 'hukuman';
    protected $fillable= [
        'nama_hukuman',
        'pointAwal',
        'pointAkhir',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    
}
