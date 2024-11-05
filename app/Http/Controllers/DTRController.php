<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DTR;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

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
        // Read the uploaded Excel file
        $data = Excel::toArray([], $request->file('file'));

        // Check if data is read successfully
        if (empty($data) || empty($data[0])) {
            return back()->with('error', 'No data found in the uploaded file.');
        }

        // Loop through the rows (assuming data is in the first sheet)
        foreach ($data[0] as $key => $row) {
            if ($key == 0) continue; // Skip the header row

            // Validate the row to ensure acc_no and date_time are present
            if (empty($row[0]) || empty($row[1])) {
                continue; // Skip if acc_no or date_time is empty
            }

            // Log the row for debugging purposes
            \Log::info('Processing row: ' . json_encode($row));
            \Log::info('Raw date_time value for row ' . ($key + 1) . ': ' . $row[1]);

            // Convert the date_time string to a Carbon instance with the correct format
            try {
                $dateTimeValue = \DateTime::createFromFormat('d/m/Y h:i:s A', $row[1]); // Ginawang uppercase ang 'A'

                // Check if the dateTimeValue is false
                if ($dateTimeValue === false) {
                    $errors = \DateTime::getLastErrors();
                    \Log::error('Date parsing errors for row: ' . json_encode($errors));
                    return back()->with('error', 'Failed to import data due to invalid date format in row: ' . ($key + 1));
                }

                // Convert DateTime to Carbon
                $dateTimeValue = Carbon::instance($dateTimeValue);
            } catch (\Exception $e) {
                \Log::error('Invalid date format for row: ' . json_encode($row) . ' - Error: ' . $e->getMessage());
                return back()->with('error', 'Failed to import data due to invalid date format in row: ' . ($key + 1));
            }

            // Create a new DTR record
            DTR::create([
                'acc_no' => $row[0],
                'date_time' => $dateTimeValue, // Use the converted DateTime
            ]);
        }

        return back()->with('success', 'Excel data imported successfully.');
    } catch (\Exception $e) {
        \Log::error('Import error: ' . $e->getMessage());
        return back()->with('error', 'Failed to import data: ' . $e->getMessage());
    }
}

}
