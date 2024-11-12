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
                $weekRowStart = [
                    1 => 13,
                    2 => 20 
                ];

                $firstDayOfMonth = date('Y-m-01', strtotime($this->from_date));
                $firstWeekday = date('N', strtotime($firstDayOfMonth)); 

                foreach ($this->dtrRecords as $date => $times) {
                    $currentDayOfWeek = date('N', strtotime($date)); 
                    $dayOfMonth = date('j', strtotime($date)); 
                    $weekOfMonth = (int) ceil(($dayOfMonth + $firstWeekday - 1) / 7);

                    $row = $weekRowStart[$weekOfMonth] + ($currentDayOfWeek - 1);

                    $templateSheet->setCellValue("B{$row}", $date);
                    $templateSheet->setCellValue("E{$row}", $times['morning_in'] ?? 'N/A');
                    $templateSheet->setCellValue("F{$row}", $times['morning_out'] ?? 'N/A');
                    $templateSheet->setCellValue("G{$row}", $times['afternoon_in'] ?? 'N/A');
                    $templateSheet->setCellValue("H{$row}", $times['afternoon_out'] ?? 'N/A');
                }

                $templateSheet->getProtection()->setSheet(true);
                $templateSheet->getProtection()->setPassword('sandok.sinigangnahilaw123');

                $event->sheet->getDelegate()->getParent()->removeSheetByIndex(0);
                $event->sheet->getDelegate()->getParent()->addExternalSheet($templateSheet);
            },
        ];
    }
}
