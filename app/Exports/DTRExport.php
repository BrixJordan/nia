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
            $templateSheet->setCellValue('D8', $this->employee->full_name);
            $templateSheet->setCellValue('D9', "{$this->from_date} - {$this->to_date}");

            $row = 12;

            $startDate = strtotime($this->from_date);
            $endDate = strtotime($this->to_date);

            for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate = strtotime("+1 day", $currentDate)) {
                $formattedDate = date('m/d/Y', $currentDate);
                $dayName = date('l', $currentDate);

                $templateSheet->setCellValue("B{$row}", $formattedDate);
                $templateSheet->setCellValue("C{$row}", $dayName);
                $templateSheet->setCellValue("R{$row}", date('d', $currentDate));

                // Check if it's a weekend (Saturday or Sunday)
                if (in_array($dayName, ['Saturday', 'Sunday'])) {
                   
                    $templateSheet->getStyle("B{$row}:C{$row}")->getFont()->getColor()->setRGB('FF0000'); 
                    $templateSheet->getStyle("R{$row}")->getFont()->getColor()->setRGB('FF0000');
                    // Clear time-related columns for weekends
                    $templateSheet->setCellValue("E{$row}", '');
                    $templateSheet->setCellValue("F{$row}", '');
                    $templateSheet->setCellValue("G{$row}", '');
                    $templateSheet->setCellValue("H{$row}", '');
                } else {
                    // Fill time-related columns for weekdays
                    $dateKey = date('Y-m-d', $currentDate);
                    $times = $this->dtrRecords[$dateKey] ?? null;

                    $templateSheet->setCellValue("E{$row}", $times['morning_in'] ?? 'N/A');
                    $templateSheet->setCellValue("F{$row}", $times['morning_out'] ?? 'N/A');
                    $templateSheet->setCellValue("G{$row}", $times['afternoon_in'] ?? 'N/A');
                    $templateSheet->setCellValue("H{$row}", $times['afternoon_out'] ?? 'N/A');
                }

                $row++;
            }

            $templateSheet->getProtection()->setSheet(true);
            $templateSheet->getProtection()->setPassword('sandok.sinigangnahilaw123');
            $event->sheet->getDelegate()->getParent()->removeSheetByIndex(0);
            $event->sheet->getDelegate()->getParent()->addExternalSheet($templateSheet);
        },
    ];
}


}