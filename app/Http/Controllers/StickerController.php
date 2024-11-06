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
    public function index(Request $request)
{
    $search = $request->input('search');
    $stickers = Sticker::when($search, function ($query, $search) {
            return $query->where('accountable', 'like', '%' . $search . '%')
                         ->orWhere('property_no', 'like', '%' . $search . '%')
                         ->orWhere('serial_no', 'like', '%' . $search . '%')
                         ->orWhere('model_no', 'like', '%' . $search . '%');
        })
        ->orderBy('accountable') // Sort by accountable
        ->paginate(3); 

    return view('stickers.index', compact('stickers', 'search'));
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

  
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');

        $imageUrl = asset('storage/' . $imagePath); 

        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($imageUrl) . '&size=200x200';

        $qrCodeImage = file_get_contents($qrCodeUrl);
        $qrCodePath = 'images/qrcodes/' . time() . '.png';
        file_put_contents(public_path($qrCodePath), $qrCodeImage);

        Sticker::create([
            'property_no' => $request->property_no,
            'serial_no' => $request->serial_no,
            'model_no' => $request->model_no,
            'description' => $request->description,
            'acquisition_date' => $request->acquisition_date,
            'acquisition_cost' => $request->acquisition_cost,
            'accountable' => $request->accountable,
            'image_path' => $imagePath, 
            'qr_code_path' => $qrCodePath, 
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
   
    $sticker = Sticker::findOrFail($id);
    return response()->json($sticker); 
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


    $sticker = Sticker::findOrFail($id);

    $sticker->property_no = $request->property_no;
    $sticker->serial_no = $request->serial_no;
    $sticker->model_no = $request->model_no;
    $sticker->description = $request->description;
    $sticker->acquisition_date = $request->acquisition_date;
    $sticker->acquisition_cost = $request->acquisition_cost;
    $sticker->accountable = $request->accountable;

    if ($request->hasFile('image')) {

        $sticker->image_path = $request->file('image')->store('stickers', 'public');
    }

    $sticker->save();

    return redirect()->route('stickers.index')->with('success', 'Sticker updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
   
    $sticker = Sticker::findOrFail($id);


    if ($sticker->qr_code_path && file_exists(public_path($sticker->qr_code_path))) {
        unlink(public_path($sticker->qr_code_path));
    }

    if ($sticker->image_path && file_exists(public_path('storage/' . $sticker->image_path))) {
        unlink(public_path('storage/' . $sticker->image_path));
    }

   
    $sticker->delete();

    return redirect()->route('stickers.index')->with('success', 'Sticker deleted successfully.');
}
}
