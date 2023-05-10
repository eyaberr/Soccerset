<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $users = User::where('role_id', User::ROLES['trainer'])
            ->orWhere('role_id', User::ROLES['parent'])
            ->get();

        return response()->json($users);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {
            $user = Auth::user();
            // check if user is a trainer
            if ($user->role_id !== User::ROLES['trainer']) {
                throw new \Exception('this user is not a trainer', 422);
            }
            $user = User::with('events')->findOrFail($user->id);
            return response()->json([
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return \response()->json([
                'message' => $e->getMessage(),
            ], $e->getCode());
        }
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
        //
    }
}
