<?php

namespace App\Http\Controllers;
use App\Models\Coach;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $coaches = Coach::all();
        return view('coaches.index', compact('coaches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coaches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'specialization' => 'required|string',
            'bio' => 'nullable|string',
            'contact_number' => 'nullable|string',
        ]);

        Coach::create($request->all());

        return redirect()->route('coaches.index')->with('success', 'Coach added successfully.');
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
         $coach = Coach::findOrFail($id);
         return view('coaches.edit', compact('coach'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $request->validate([
            'name' => 'required|string',
            'specialization' => 'required|string',
            'bio' => 'nullable|string',
            'contact_number' => 'nullable|string',
        ]);

        // $coach->update($request->all());
        // Fetch the coach by id first
    $coach = Coach::findOrFail($id);

    // Then update with validated data
    $coach->update($request->only(['name', 'specialization', 'bio', 'contact_number']));

        return redirect()->route('coaches.index')->with('success', 'Coach updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $coach = Coach::findOrFail($id);
        $coach->delete();

        return redirect()->route('coaches.index')->with('success', 'Coach deleted successfully.');
    }

    public function list()
{
    $coaches = Coach::all();
    return view('coaches.list', compact('coaches'));
}

}
