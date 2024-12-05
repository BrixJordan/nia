<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all();
        return view('Ticket.index', compact('tickets'));
        //
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
        $validated = $request->validate([
            'ITST_no' => 'required|unique:tickets,ITST_no',
            'date' => 'required|date',
            'time' => 'required',
            'client_name' => 'required|string|max:100',
            'office' => 'required|string|max:100',
            'equipment_type' => 'required|string|max:100',
            'serial_no' => 'required|string|max:100',
            'problem' => 'required|string|max:255',
            'validated_problem' => 'required|string|max:255',
        ]);

        Ticket::create($validated);
        return redirect()->back()->with('success', 'Ticket created successfully!');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ticket = Ticket::findorFail($id);
        return response()->json($ticket);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'ITST_no' => 'required|unique:tickets,ITST_no',
            'date' => 'required|date',
            'time' => 'required',
            'client_name' => 'required|string|max:100',
            'office' => 'required|string|max:100',
            'equipment_type' => 'required|string|max:100',
            'serial_no' => 'required|string|max:100',
            'problem' => 'required|string|max:255',
            'validated_problem' => 'required|string|max:255',
        ]);

        $ticket->update($request->all());
        return redirect()->route('Ticket.index')->with('success', 'Ticket Updated successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        

        $ticket->delete();
        return redirect()->back()->with('success', 'Ticket Deleted Successfully');
        //
    }
}
