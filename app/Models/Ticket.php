<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'ITST_no',
        'date',
        'time',
        'client_name',
        'office',
        'equipment_type',
        'serial_no',
        'problem',
        'validated_problem'
    ];
}
