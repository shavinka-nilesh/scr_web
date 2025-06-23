<?php

namespace App\Http\Controllers;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $facilities = Facility::all();
        return view('facilities.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('facilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string',
            'sport_type' => 'required|string',
            'capacity' => 'required|string',
            'location' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Facility::create($request->all());

        return redirect()->route('facilities.index')->with('success', 'Facilitiey added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $facility = Facility::findOrFail($id);
         return view('facilities.edit', compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'name' => 'required|string',
            'sport_type' => 'required|string',
            'capacity' => 'required|string',
            'location' => 'required|string',
            'description' => 'nullable|string',
        ]);

        // $coach->update($request->all());
        // Fetch the coach by id first
    $facility = Facility::findOrFail($id);

    // Then update with validated data
    $facility->update($request->only(['name', 'sport_type', 'capacity', 'location', 'description']));

        return redirect()->route('facilities.index')->with('success', 'Facility updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $facility = Facility::findOrFail($id);
        $facility->delete();

        return redirect()->route('facilities.index')->with('success', 'Facility deleted successfully.');
    }
}
