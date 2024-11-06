<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DTR extends Model
{
    use HasFactory;
    protected $table = 'dtr_records';
    protected $fillable = [
        'acc_no', 'date_time', 
    ];
}
