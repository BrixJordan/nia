<?php

namespace App\Http\Controllers;

use App\Models\Sticker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class StickerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stickers = Sticker::all();
         // Fetch all stickers from the database
        return view('stickers.index', compact('stickers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'property_no' => 'required',
        'serial_no' => 'required',
        'model_no' => 'required',
        'description' => 'required',
        'acquisition_date' => 'required|date',
        'acquisition_cost' => 'required|numeric',
        'accountable' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle the image upload
    if ($request->hasFile('image')) {
        // Save the image in the public/images folder
        $imagePath = $request->file('image')->store('images', 'public');

        // Generate the image URL
        $imageUrl = asset('storage/' . $imagePath); // This should point to public/storage/images

        // Use GoQR API to generate the QR code for the image URL
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($imageUrl) . '&size=200x200';

        // Download the generated QR code image
        $qrCodeImage = file_get_contents($qrCodeUrl);
        $qrCodePath = 'images/qrcodes/' . time() . '.png';
        file_put_contents(public_path($qrCodePath), $qrCodeImage);

        // Create the sticker record in the database
        Sticker::create([
            'property_no' => $request->property_no,
            'serial_no' => $request->serial_no,
            'model_no' => $request->model_no,
            'description' => $request->description,
            'acquisition_date' => $request->acquisition_date,
            'acquisition_cost' => $request->acquisition_cost,
            'accountable' => $request->accountable,
            'image_path' => $imagePath, // Store the image path
            'qr_code_path' => $qrCodePath, // Store the QR code path
        ]);
    }

    return redirect()->route('stickers.index')->with('success', 'Sticker created successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(Sticker $sticker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    // Retrieve the sticker by its ID
    $sticker = Sticker::findOrFail($id);
    return response()->json($sticker); // Return sticker data as JSON
}

public function update(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'property_no' => 'required|string|max:255',
        'serial_no' => 'required|string|max:255',
        'model_no' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'acquisition_date' => 'required|date',
        'acquisition_cost' => 'required|numeric',
        'accountable' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Find the sticker to update
    $sticker = Sticker::findOrFail($id);
    // Update sticker details
    $sticker->property_no = $request->property_no;
    $sticker->serial_no = $request->serial_no;
    $sticker->model_no = $request->model_no;
    $sticker->description = $request->description;
    $sticker->acquisition_date = $request->acquisition_date;
    $sticker->acquisition_cost = $request->acquisition_cost;
    $sticker->accountable = $request->accountable;

    // Handle the image upload if a new image is provided
    if ($request->hasFile('image')) {
        // Save the new image and update the image_path
        $sticker->image_path = $request->file('image')->store('stickers', 'public');
    }

    // Save the updated sticker
    $sticker->save();

    return redirect()->route('stickers.index')->with('success', 'Sticker updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Find the sticker by ID
    $sticker = Sticker::findOrFail($id);

    // Delete the QR code file if it exists
    if ($sticker->qr_code_path && file_exists(public_path($sticker->qr_code_path))) {
        unlink(public_path($sticker->qr_code_path));
    }

    // Delete the image file if it exists
    if ($sticker->image_path && file_exists(public_path('storage/' . $sticker->image_path))) {
        unlink(public_path('storage/' . $sticker->image_path));
    }

    // Delete the sticker record from the database
    $sticker->delete();

    // Redirect back with a success message
    return redirect()->route('stickers.index')->with('success', 'Sticker deleted successfully.');
}
}
