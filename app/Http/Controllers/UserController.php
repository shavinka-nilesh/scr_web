<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $User = User::all();
        return view('users.index', compact('User'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'role' => 'required|string',
         'password' => 'required|string|min:8|confirmed',
            //  'images.*' => 'image|mimes:jpg,jpeg,png|max:2048', // max 2MB per image
        ]);

        $data = $request->only(['name', 'email', 'role','phone_number','address']);

$data['password'] = $request->password;

User::create($data);
  return redirect()->route('users.index')->with('success', 'User added successfully.');
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
          $User = User::findOrFail($id);
         return view('users.edit', compact('User'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
          $User = User::findOrFail($id);
          if ($User->bookings()->exists()) {
    return redirect()->route('users.index')
        ->with('error', 'Cannot delete facility with active bookings.');
}else{
 $User->delete();
}
       


        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    
    }

    public function changePassword(Request $request, $id)
{
    $request->validate([
        'new_password' => 'required|string|min:8|confirmed',
        'admin_password' => 'required|string',
    ]);

    $admin = auth()->user();

    if (!Hash::check($request->admin_password, $admin->password)) {
        return back()->withErrors(['admin_password' => 'Incorrect admin password.']);
    }

    $user = User::findOrFail($id);
    $user->update(['password' => $request->new_password]);

    return back()->with('success', 'Password updated successfully.');
}
}
