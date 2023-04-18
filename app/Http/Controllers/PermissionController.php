<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions=Permission::paginate(20);
        return view ('permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',        ]);
        $permission=new Permission();
        $permission->name = $request->input('name');
        $permission->save();
        return redirect()->route('permissions.index')->with('success', __('messages.permission_successfully_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission=Permission::findOrFail($id);
        return view('permissions.show',compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission=Permission::findOrFail($id);
        return view('permissions.edit',compact('permission'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',        ]);
        $permission=Permission::findOrFail($id);
        $permission->name = $request->input('name');
        $permission->save();
        return redirect()->route('permissions.index')->with('success', __('messages.permission_successfully_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission=Permission::findOrFail($id);
        if ($permission) {
            $permission->delete();
            return redirect()->route('permissions.index')->with('success', __('messages.permission_successfully_deleted'));
        }
    }
}
