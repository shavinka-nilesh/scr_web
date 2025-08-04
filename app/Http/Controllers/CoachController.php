<?php

namespace App\Http\Controllers;
use App\Models\Coach;
use App\Models\SportType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $sportTypes = SportType::all();
        return view('coaches.create', compact('sportTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'specialization' => 'required|string',
             'sport_type_id' => 'nullable|string',
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
          $sportTypes = SportType::all();
         return view('coaches.edit', compact('coach','sportTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $request->validate([
            'name' => 'required|string',
            'specialization' => 'required|string',
             'sport_type_id' => 'nullable|string',
            'bio' => 'nullable|string',
            'contact_number' => 'nullable|string',
        ]);

        // $coach->update($request->all());
        // Fetch the coach by id first
    $coach = Coach::findOrFail($id);

    // Then update with validated data
    $coach->update($request->only(['name', 'specialization', 'bio', 'contact_number','sport_type_id']));

        return redirect()->route('coaches.index')->with('success', 'Coach updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $coach = Coach::findOrFail($id);
          if ($coach->coachingSessions()->exists()) {
            Log::info('Coach cant delete');
        return redirect()->route('coaches.index') ->with('error', 'Cannot delete coach with scheduled coaching sessions.');
    } else{
 $coach->delete();

        
    }

       return redirect()->route('coaches.index')->with('success', 'Coach deleted successfully.');
    }

  public function list(Request $request)
{
    $query = $request->input('search');

    $coaches = Coach::query()
        ->when($query, function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('specialization', 'like', "%{$query}%");
        })
        ->get();

    return view('coaches.list', compact('coaches'));
}

}
