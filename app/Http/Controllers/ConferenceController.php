<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConferenceRequest;
use App\Models\Conference;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    public function index()
    {
        return response()->json(Conference::all());
    }

    public function store(ConferenceRequest $request)
    {
        $conference = Conference::create($request->validated());

        return response()->json($conference, 201);
    }


    public function show($id)
    {
        $conference = Conference::findOrFail($id);
        return response()->json($conference);
    }

    public function update(Request $request, $id)
    {
        $conference = Conference::findOrFail($id);
        $conference->update($request->all());

        return response()->json($conference);
    }

    public function destroy($id)
    {
        $conference = Conference::findOrFail($id);
        $conference->delete();

        return response()->json(null, 204);
    }
}
