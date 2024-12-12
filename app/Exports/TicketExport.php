<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Concerns\WithEvents;

class TicketExport implements WithEvents
{
    protected $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function registerEvents(): array
    {
        return [
            BeforeExport::class => function () {
                $spreadsheet = IOFactory::load(resource_path('templates/tickettemplate.xlsx'));
                $sheet = $spreadsheet->getActiveSheet();

                // Insert the data into the specified cells
                $sheet->setCellValue('B9', $this->ticket->ITST_no);
                $sheet->setCellValue('B10', $this->ticket->date);
                $sheet->setCellValue('B11', $this->ticket->time);
                $sheet->setCellValue('E9', $this->ticket->client_name);
                $sheet->setCellValue('E10', $this->ticket->office);
                $sheet->setCellValue('E11', $this->ticket->equipment_type);
                $sheet->setCellValue('E12', $this->ticket->serial_no);
                $sheet->setCellValue('D14', $this->ticket->problem);
                $sheet->setCellValue('D15', $this->ticket->validated_problem);

                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output');
            },
        ];
    }
}
