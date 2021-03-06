<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Tenhim extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'tenhim';

    protected $fillable = ['ner', 'tovch'];
    
    protected static $logAttributes = ['ner', 'tovch'];
}
