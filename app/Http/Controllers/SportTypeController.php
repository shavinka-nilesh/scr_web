<?php

namespace App\Http\Controllers;

use App\Models\SportType;
use Illuminate\Http\Request;

class SportTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $SportType = SportType::all();
        return view('sport_types.index', compact('SportType'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view('sport_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        SportType::create($request->all());

        return redirect()->route('sport_types.index')->with('success', 'Sport added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SportType $sportType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $SportType = SportType::findOrFail($id);
         return view('sport_types.edit', compact('SportType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

              // $coach->update($request->all());
        // Fetch the coach by id first
    $SportType = SportType::findOrFail($id);

    // Then update with validated data
    $SportType->update($request->only(['name', 'description',]));

        return redirect()->route('sport_types.index')->with('success', 'Coach updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $SportType = SportType::findOrFail($id);
        $SportType->delete();

        return redirect()->route('sport_types.index')->with('success', 'Coach deleted successfully.');
    }

        public function list()
{
    $SportType = SportType::all();
    return view('sport_types.list', compact('SportType'));
}
}
