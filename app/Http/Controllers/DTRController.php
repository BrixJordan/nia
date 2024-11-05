<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DTR;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DTRController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('DTR.index');
    }

    /**
     * Import data from an Excel file.
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
           
            $data = Excel::toArray([], $request->file('file'));

            if (empty($data) || empty($data[0])) {
                return back()->with('error', 'No data found in the uploaded file.');
            }

            
            foreach ($data[0] as $key => $row) {
                if ($key == 0) continue;

                
                if (empty($row[0]) || empty($row[1])) {
                    continue; 
                }

                
                try {
                    $dateString = trim($row[1]);

                    
                    if (is_numeric($dateString)) {
                        $dateTimeValue = Date::excelToDateTimeObject($dateString);
                    } else {
                        $dateTimeValue = \DateTime::createFromFormat('d/m/Y h:i:s A', $dateString);
                    }

                  
                    $dateTimeValue = Carbon::instance($dateTimeValue);

                    
                    if (!$dateTimeValue instanceof Carbon) {
                        return back()->with('error', 'Failed to import data due to invalid date value in row: ' . ($key + 1));
                    }

                   
                    DTR::create([
                        'acc_no' => $row[0],
                        'date_time' => $dateTimeValue, 
                    ]);
                } catch (\Exception $e) {
                    \Log::error('Invalid date format for row: ' . json_encode($row) . ' - Error: ' . $e->getMessage());
                    return back()->with('error', 'Failed to import data due to invalid date format in row: ' . ($key + 1));
                }
            }

            return back()->with('success', 'Excel data imported successfully.');
        } catch (\Exception $e) {
            \Log::error('Import error: ' . $e->getMessage());
            return back()->with('error', 'Failed to import data: ' . $e->getMessage());
        }
    }
}
