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
                $templateSheet->setCellValue('D8', $this->employee->full_name);
                $templateSheet->setCellValue('D9', "{$this->from_date} - {$this->to_date}");

                // Define starting rows for each week in the template
                $weekRowStart = [
                    1 => 13, // Row start for the first week
                    2 => 20  // Row start for the second week
                ];

                // Get the starting day of the week for the first day of the month
                $firstDayOfMonth = date('Y-m-01', strtotime($this->from_date));
                $firstWeekday = date('N', strtotime($firstDayOfMonth)); // 1 (Mon) - 7 (Sun)

                foreach ($this->dtrRecords as $date => $times) {
                    $currentDayOfWeek = date('N', strtotime($date)); // Day of the week (1-7)
                    $dayOfMonth = date('j', strtotime($date)); // Day of the month (1-31)
                    
                    // Determine the appropriate week within the month
                    $weekOfMonth = (int) ceil(($dayOfMonth + $firstWeekday - 1) / 7);

                    // Calculate row based on week start and day of the week
                    $row = $weekRowStart[$weekOfMonth] + ($currentDayOfWeek - 1);

                    // Set date in column B and DTR time values in other columns
                    $templateSheet->setCellValue("B{$row}", $date); // Set date in column B
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
