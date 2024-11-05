<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\Employee;
use Illuminate\Http\Request;  // <-- Add this import
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        // Get search query from the request
        $search = $request->input('search');

        // Retrieve employees with pagination and search functionality
        $employees = Employee::when($search, function ($query) use ($search) {
            return $query->where('full_name', 'like', "%{$search}%")
                         ->orWhere('acc_no', 'like', "%{$search}%")
                         ->orWhere('department', 'like', "%{$search}%");
        })->paginate(10); // Adjust the number of items per page as needed

        return view('employee.index', compact('employees', 'search'));
    }

    public function importExcel(Request $request)  // Now it recognizes the Request class
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            // Read the uploaded Excel file
            $data = Excel::toArray([], $request->file('file'));

            // Loop through the rows (assuming data is in the first sheet)
            foreach ($data[0] as $key => $row) {
                if ($key == 0) continue; // Skip the header row

                Employee::create([
                    'acc_no' => $row[0],
                    'full_name' => $row[1],
                    'department' => $row[2],
                ]);
            }

            return back()->with('success', 'Excel data imported successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to import data: ' . $e->getMessage());
        }
    }

    public function generateDtr(Request $request)
{
    $request->validate([
        'employee' => 'required',
        'from_date' => 'required|date',
        'to_date' => 'required|date|after_or_equal:from_date',
    ]);

    $acc_no = $request->employee;
    $from = $request->from_date . ' 00:00:00';
    $to = $request->to_date . ' 23:59:59';

    // Retrieve logs for the employee within the date range
    $logs = \DB::table('dtr_records')
        ->where('acc_no', $acc_no)
        ->whereBetween('date_time', [$from, $to])
        ->orderBy('date_time')
        ->get();

    // Group logs by day and process for morning/afternoon
    $dtr = [];
    foreach ($logs as $log) {
        $day = date('Y-m-d', strtotime($log->date_time));

        if (!isset($dtr[$day])) {
            $dtr[$day] = ['morning_in' => null, 'morning_out' => null, 'afternoon_in' => null, 'afternoon_out' => null];
        }

        $time = date('H:i:s', strtotime($log->date_time));

        if ($time <= '12:00:00') {
            if (!$dtr[$day]['morning_in']) {
                $dtr[$day]['morning_in'] = $time;
            } else {
                $dtr[$day]['morning_out'] = $time;
            }
        } else {
            if (!$dtr[$day]['afternoon_in']) {
                $dtr[$day]['afternoon_in'] = $time;
            } else {
                $dtr[$day]['afternoon_out'] = $time;
            }
        }
    }

    return view('dtr.result', compact('dtr', 'acc_no'));
}

}
