<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Subuser;
use Illuminate\Http\Request;

class SubuserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Subuser::class, 'subuser');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subusers = Subuser::with('role')->get();
        return view('subusers.index', compact('subusers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('subusers.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:subusers,email',
            'password' => 'required|string|min:8',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        Subuser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);
        return redirect()->route('subusers.index')->with('success', 'Subuser created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subuser $subuser)
    {
        return view('subusers.show', compact('subuser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subuser $subuser)
    {
        $roles = Role::orderBy('name')->get();
        return view('subusers.edit', compact('subuser', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subuser $subuser)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:subusers,email,' . $subuser->id,
            'password' => 'nullable|string|min:8',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        $data = $request->only(['name', 'email', 'role_id']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $subuser->update($data);
        return redirect()->route('subusers.index')->with('success', 'Subuser updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subuser $subuser)
    {
        $subuser->delete();
        return redirect()->route('subusers.index')->with('success', 'Subuser deleted successfully');
    }
}
