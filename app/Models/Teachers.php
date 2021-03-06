<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;

    protected $fillable = [
        'ner',
        'ovog',
        'urag',
        'tursun',
        'register',
        'code',
        'password',
        'phone',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function scopeProfile($query, $t_id)
    // {
    //     return $query->select('teachers.*')//, 'teachers.ner', 'teachers.ovog', 'teachers.image', 'teachers.code', 'teachers.t_id', 'teacher_mergejil.ner as mergejil', 'tenhim.ner as tenhim', 'tenhim.tovch')
    //                         // ->join('teacher_mergejil', 'teacher_mergejil.id', '=', 'teachers.mb_id')
    //                         // ->join('tenhim', 'tenhim.id', '=', 'teachers.t_id')
    //                         ->where('teachers.t_id', $t_id);
        
    // }
}
