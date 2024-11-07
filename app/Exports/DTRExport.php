<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class DTRExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    protected $dtrRecords;
    protected $employee;

    public function __construct($dtrRecords, $employee)
    {
        $this->dtrRecords = $dtrRecords;
        $this->employee = $employee;
    }

    public function collection()
    {
        return collect($this->dtrRecords)->map(function ($times, $date) {
            return [
                'date' => $date,
                'morning_in' => $times['morning_in'] ?? 'N/A',
                'morning_out' => $times['morning_out'] ?? 'N/A',
                'afternoon_in' => $times['afternoon_in'] ?? 'N/A',
                'afternoon_out' => $times['afternoon_out'] ?? 'N/A',
            ];
        });
    }

    public function headings(): array
    {
        return ['Date', 'Morning In', 'Morning Out', 'Afternoon In', 'Afternoon Out'];
    }

    public function title(): string
    {
        return 'DTR';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getProtection()->setSheet(true); // Protect sheet
            },
        ];
    }
}
