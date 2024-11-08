<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DTRExport implements FromArray, WithEvents
{
    protected $dtrRecords;
    protected $employee;
    protected $from_date;
    protected $to_date;
    protected $templatePath = 'templates/template.xlsx'; 

    public function __construct($dtrRecords, $employee, $from_date, $to_date)
    {
        $this->dtrRecords = $dtrRecords;
        $this->employee = $employee;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function array(): array
    {
        return []; 
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Load the template Excel file
                $template = IOFactory::load(resource_path($this->templatePath));
                $templateSheet = $template->getActiveSheet();

                // Set employee info in specific cells
                $templateSheet->setCellValue('B8', $this->employee->full_name);
                $templateSheet->setCellValue('B9', "{$this->from_date} - {$this->to_date}");

                // Map days to rows (e.g., Monday starts at row 14 for E-H columns)
                $dayRowMap = [
                    'Sunday' => 12,
                    'Monday' => 13,
                    'Tuesday' => 14,
                    'Wednesday' => 15,
                    'Thursday' => 16,
                    'Friday' => 17,
                    'Saturday' => 18,
                ];

                // Insert DTR records based on mapped rows
                foreach ($this->dtrRecords as $date => $times) {
                    $dayOfWeek = date('l', strtotime($date));
                    $row = $dayRowMap[$dayOfWeek];

                    // Set cell values in the template sheet for each time entry
                    $templateSheet->setCellValue("E{$row}", $times['morning_in'] ?? 'N/A');
                    $templateSheet->setCellValue("F{$row}", $times['morning_out'] ?? 'N/A');
                    $templateSheet->setCellValue("G{$row}", $times['afternoon_in'] ?? 'N/A');
                    $templateSheet->setCellValue("H{$row}", $times['afternoon_out'] ?? 'N/A');
                }

                // Replace the default sheet with the modified template sheet
                $event->sheet->getDelegate()->getParent()->removeSheetByIndex(0);
                $event->sheet->getDelegate()->getParent()->addExternalSheet($templateSheet);
            },
        ];
    }
}
