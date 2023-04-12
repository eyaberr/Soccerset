<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\User;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $children = Child::paginate(5);
        $user = User::all();
        return view('children.index', compact('children', 'user'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users=User::all();
        return view('children.index',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'parent' => 'required|string|max:255|exists:users,id',
            'age' => 'required|string|max:255',
        ]);
        $child = new Child([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'parent' => $request->get('user_id'),
            'age' => $request->get('age'),
        ]);

        $child->save();

        return redirect()->route('children.index')->with('success', 'Child has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::all();
        return view('children.create', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $child = Child::find($id);
        $users = User::all();
        return view('children.edit', compact('child', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'parent' => 'required|string|max:255|exists:users,id',
            'age' => 'required|string|max:255',

        ]);
        $child = Child::find($id);
        $child->save();

        return redirect()->route('children.index')->with('success', 'Child Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $child = Child::find($id);
        if ($child) {
            $child->delete();
            return redirect()->route('children.index')->with('success', 'Child has been deleted successfully');
        }
    }
}
