<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DTR extends Model
{
    use HasFactory;
    protected $table = 'dtr_records';
    protected $fillable = [
        'acc_no', 'date_and_time', // I-add ang iba pang fields kung kinakailangan
    ];
}
