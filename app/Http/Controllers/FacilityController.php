<?php

namespace App\Http\Controllers;
use App\Models\Facility;
use App\Models\SportType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\FacilityImage;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $facilities = Facility::with(['sportType'])->get();
        return view('facilities.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            $SportType = SportType::all();
        return view('facilities.create', compact('SportType'));
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
             'images.*' => 'image|mimes:jpg,jpeg,png|max:2048', // max 2MB per image
        ]);

        $facility = Facility::create($request->only(['name', 'sport_type', 'capacity', 'location', 'description']));

       // ✅ Upload each image
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('facilities', 'public');
            $facility->images()->create(['path' => $path]);
        }
    }

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
    {   $SportType = SportType::all();
          $facility = Facility::findOrFail($id);
         return view('facilities.edit', compact('facility','SportType'));
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
if ($request->hasFile('images')) {
    foreach ($request->file('images') as $file) {
        $path = $file->store('facilities', 'public');
        $facility->images()->create(['path' => $path]);
    }
}

        return redirect()->route('facilities.index')->with('success', 'Facility updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
          $facility = Facility::findOrFail($id);
          if ($facility->bookings()->exists()) {
    return redirect()->route('facilities.index')
        ->with('error', 'Cannot delete facility with active bookings.');
}else{
 $facility->delete();
}
       


        return redirect()->route('facilities.index')->with('success', 'Facility deleted successfully.');
    }

    public function deleteImage($id)
{
    $image = FacilityImage::findOrFail($id);

    // Delete the image file
    // \Storage::disk('public')->delete($image->path);

    // Delete the DB record
    $image->delete();

    return response()->json(['success' => true]);
}

public function list(Request $request)
{
    $search = $request->input('search');

    $facilities = Facility::with('images')
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('sport_type', 'like', "%{$search}%");
        })
        ->get();

    return view('facilities.list', compact('facilities'));
}

}
