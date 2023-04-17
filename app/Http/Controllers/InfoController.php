<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infos = Info::with('group')->paginate(10);
        return view('infos.index', compact('infos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = Group::all();
        return view('infos.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'group' => 'required|string|max:255|exists:groups,id',
        ]);

        $info = new Info([
            'content' => $request->get('content'),
            'group_id' => $request->get('group'),
        ]);

        $info->save();

        return redirect()->route('infos.index')->with('success', __('messages.info_successfully_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $info = Info::find($id);
        return view('infos.show', compact('info'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $info = Info::find($id);
        $groups=Group::all();
        return view('infos.edit', compact('info', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'group' => 'required|string|max:255|exists:groups,id',
        ]);

        $info = Info::find($id);
        $info->content = $request->get('content');
        $info->group_id = $request->get('group');
        $info->save();

        return redirect()->route('infos.index')->with('success', __('messages.info_successfully_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
