<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\Employee;
use Illuminate\Http\Request;  
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


 


    

}
