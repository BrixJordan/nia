<?php

namespace App\Exports;

use App\Models\DTR;
use Maatwebsite\Excel\Concerns\FromCollection;

class DTRExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DTR::all();
    }
}
