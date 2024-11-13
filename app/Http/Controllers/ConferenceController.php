<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConferenceRequest;
use App\Models\Conference;
use App\Models\User;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    protected function toggleArrayElement(array $array, $element): array
    {
        return in_array($element, $array)
            ? array_values(array_filter($array, fn($item) => $item !== $element))
            : [...$array, $element];
    }

    public function index()
    {
        // Retrieve all conferences
        $conferences = Conference::all()->map(function ($conference) {
            // Hide the participants_ids field from each conference
            $conference->makeHidden(['participants_ids']);

            // For each conference, get the associated participant IDs and retrieve only those users
            $participants = User::whereIn('id', $conference->participants_ids ?? [])
                ->get()
                ->makeHidden(['backgroundClassName', 'conferences_ids']);

            // Return conference details along with its participants
            return $conference->toArray() + ['participants' => $participants];
        });

        // Return the response, structured as a list of conferences each with embedded participants
        return response()->json($conferences);
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

    public function partialUpdate(Request $request, $conferenceId)
    {
        $participant = $request->validate([
            'userId' => 'required|integer',
        ]);

        $userId = $participant['userId'];

        $conference = Conference::findOrFail($conferenceId);
        $user = User::findOrFail($userId);

        $participantsIds = $conference->participants_ids ?? [];
        $conferencesIds = $user->conferences_ids ?? [];

        $conference->participants_ids = $this->toggleArrayElement($participantsIds, $userId);
        $user->conferences_ids = $this->toggleArrayElement($conferencesIds, (int) $conferenceId);

        $conference->save();
        $user->save();

        return response()->json([
            'message' => 'Participant list updated successfully.',
            'conference' => $conference,
        ]);
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
