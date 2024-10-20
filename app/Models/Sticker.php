<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_no',
        'serial_no',
        'model_no',
        'description',
        'acquisition_date',
        'acquisition_cost',
        'accountable',
        'image_path',
        'qr_code_path',
        
    ];
}
