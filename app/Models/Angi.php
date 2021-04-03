<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Angi extends Model
{
    use HasFactory;
    protected $table = 'angi';

    protected $fillable = [
        'ner',
        'course',
        'buleg',
        'm_id',
        'b_id'
    ];

}
