<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Conference;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Get all users
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    // Get a user by ID
    public function show($id)
    {
        $user = User::findOrFail($id);

        // Retrieve full conference details using the IDs in conferences_ids
        $conferences = Conference::whereIn('id', $user->conferences_ids ?? [])->get();

        // Return user data, replacing conferences_ids with detailed conference objects under 'conferences'
        return response()->json(array_merge(
            $user->only(['id', 'name', 'email', 'role', 'backgroundClassName']), // User fields
            ['conferences' => $conferences]               // Full conference details
        ));
    }

    // Create a new user
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);
    }

    public function partialUpdate(Request $request, $id)
    {
        $parameters = $request->validate([
            'backgroundClassName' => 'required|string',
        ]);

        $backgroundClassName = $parameters['backgroundClassName'];

        $user = User::findOrFail($id);

        if ($user->backgroundClassName === $backgroundClassName){
            return response()->json([
                'message' => 'The backgroundClassName is already set to this value.',
            ], 400);
        }

        $user->backgroundClassName = $backgroundClassName;

        $user->save();

        return response()->json([
            'message' => 'BackgroundClassName was updated successfully.',
            'user' => $user,
        ]);
    }

    // Update a user by ID
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user);
    }
}
