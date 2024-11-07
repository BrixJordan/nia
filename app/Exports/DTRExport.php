<?php

use Illuminate\Support\Collection;

class DTRExport implements FromCollection, WithHeadings
{
    protected $dtrCollection;

    public function __construct(Collection $dtrCollection)
    {
        $this->dtrCollection = $dtrCollection;
    }

    public function collection()
    {
        return $this->dtrCollection;
    }

    public function headings(): array
    {
        return [
            'Date',
            'Morning In',
            'Morning Out',
            'Afternoon In',
            'Afternoon Out'
        ];
    }
}
