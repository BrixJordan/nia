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
                $template = IOFactory::load(resource_path($this->templatePath));
                $templateSheet = $template->getActiveSheet();

                // Set employee name and date range
                $templateSheet->setCellValue('D8', $this->employee->full_name);
                $templateSheet->setCellValue('D9', "{$this->from_date} - {$this->to_date}");

                $row = 12; // Starting row for Date (B12) and Day (C12)

                $startDate = strtotime($this->from_date);
                $endDate = strtotime($this->to_date);

                // Loop through the date range
                for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate = strtotime("+1 day", $currentDate)) {
                    $formattedDate = date('m/d/Y', $currentDate); // Format date as mm/dd/yyyy
                    $dayName = date('l', $currentDate); // Get day of the week (e.g., "Monday")

                    // Display date and day in columns B and C
                    $templateSheet->setCellValue("B{$row}", $formattedDate);
                    $templateSheet->setCellValue("C{$row}", $dayName);

                    // Display the day number in column R (for tracking purposes)
                    $templateSheet->setCellValue("R{$row}", date('d', $currentDate)); // Day number (e.g., "01" for the 1st of the month)

                    // Check if it's a weekend (Saturday or Sunday) to leave time columns blank
                    if (in_array($dayName, ['Saturday', 'Sunday'])) {
                        // Leave time-related columns blank for weekends
                        $templateSheet->setCellValue("E{$row}", '');
                        $templateSheet->setCellValue("F{$row}", '');
                        $templateSheet->setCellValue("G{$row}", '');
                        $templateSheet->setCellValue("H{$row}", '');
                    } else {
                        // Fill time-related columns for weekdays
                        $dateKey = date('Y-m-d', $currentDate); // Format the date for checking the records
                        $times = $this->dtrRecords[$dateKey] ?? null;

                        $templateSheet->setCellValue("E{$row}", $times['morning_in'] ?? 'N/A');
                        $templateSheet->setCellValue("F{$row}", $times['morning_out'] ?? 'N/A');
                        $templateSheet->setCellValue("G{$row}", $times['afternoon_in'] ?? 'N/A');
                        $templateSheet->setCellValue("H{$row}", $times['afternoon_out'] ?? 'N/A');
                    }

                    $row++; // Move to the next row
                }

                // Protect the sheet
                $templateSheet->getProtection()->setSheet(true);
                $templateSheet->getProtection()->setPassword('sandok.sinigangnahilaw123');

                // Remove default sheet and add updated template sheet
                $event->sheet->getDelegate()->getParent()->removeSheetByIndex(0);
                $event->sheet->getDelegate()->getParent()->addExternalSheet($templateSheet);
            },
        ];
    }
}
