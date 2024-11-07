<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DTR;
use App\Models\Employee;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Log;
use App\Exports\DTRExport;

class DTRController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('DTR.index', compact('employees'));
    }

//     public function export(Request $request)
// {
//     // Validate input
//     $request->validate([
//         'employee' => 'required',
//         'from_date' => 'required|date',
//         'to_date' => 'required|date|after_or_equal:from_date',
//     ]);

//     $acc_no = $request->employee;
//     $from = $request->from_date . ' 00:00:00';
//     $to = $request->to_date . ' 23:59:59';

//     // Get logs for the given employee and date range
//     $logs = \DB::table('dtr_records')
//         ->where('acc_no', $acc_no)
//         ->whereBetween('date_time', [$from, $to])
//         ->orderBy('date_time')
//         ->get();

//     // Initialize the DTR collection
//     $dtr = collect();

//     // Loop through each log and process time records
//     foreach ($logs as $log) {
//         $day = date('Y-m-d', strtotime($log->date_time));

//         // If the day doesn't exist in the collection, initialize it with default values
//         if (!$dtr->has($day)) {
//             $dtr->put($day, ['morning_in' => null, 'morning_out' => null, 'afternoon_in' => null, 'afternoon_out' => null]);
//         }

//         $time = date('H:i:s', strtotime($log->date_time));

//         // Process the morning times (before 12:00)
//         if ($time <= '12:00:00') {
//             if (!$dtr[$day]['morning_in']) {
//                 $dtr->put($day, array_merge($dtr->get($day), ['morning_in' => $time]));
//             } else {
//                 $dtr->put($day, array_merge($dtr->get($day), ['morning_out' => $time]));
//             }
//         }
//         // Process the afternoon times (after 12:00)
//         else {
//             if (!$dtr[$day]['afternoon_in']) {
//                 $dtr->put($day, array_merge($dtr->get($day), ['afternoon_in' => $time]));
//             } else {
//                 $dtr->put($day, array_merge($dtr->get($day), ['afternoon_out' => $time]));
//             }
//         }
//     }

//     // Create a collection of DTR data with the date and times
//     $dtrCollection = $dtr->map(function ($times, $date) {
//         return array_merge(['date' => $date], $times);
//     })->values();

//     // Flash success message
//     session()->flash('success', 'DTR exported successfully for the selected employee and date range.');

//     // Export the DTR data to an Excel file
//     return Excel::download(new DTRExport($dtrCollection), 'DTR_Report.xlsx');
// }







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

    public function generateDTR(Request $request)
{
    $request->validate([
        'employee' => 'required',
        'from_date' => 'required|date',
        'to_date' => 'required|date|after_or_equal:from_date',
    ]);

    $acc_no = $request->employee;
    $from = $request->from_date . ' 00:00:00';
    $to = $request->to_date . ' 23:59:59';

    $logs = \DB::table('dtr_records')
        ->where('acc_no', $acc_no)
        ->whereBetween('date_time', [$from, $to])
        ->orderBy('date_time')
        ->get();

    $dtr = collect();
    foreach ($logs as $log) {
        $day = date('Y-m-d', strtotime($log->date_time));
        if (!$dtr->has($day)) {
            $dtr->put($day, [
                'morning_in' => 'N/A',
                'morning_out' => 'N/A',
                'afternoon_in' => 'N/A',
                'afternoon_out' => 'N/A',
            ]);
        }

        $time = date('H:i:s', strtotime($log->date_time));
        if ($time <= '12:00:00') {
            if ($dtr[$day]['morning_in'] === 'N/A') {
                $dtr->put($day, array_merge($dtr->get($day), ['morning_in' => $time]));
            } else {
                $dtr->put($day, array_merge($dtr->get($day), ['morning_out' => $time]));
            }
        } else {
            if ($dtr[$day]['afternoon_in'] === 'N/A') {
                $dtr->put($day, array_merge($dtr->get($day), ['afternoon_in' => $time]));
            } else {
                $dtr->put($day, array_merge($dtr->get($day), ['afternoon_out' => $time]));
            }
        }
    }

    return view('DTR.dtr_preview', ['dtrRecords' => $dtr, 'employee' => Employee::find($acc_no)]);
}



}
