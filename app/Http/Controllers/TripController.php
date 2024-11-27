<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Trip;
use App\Models\TripPitstop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function startTrip(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tour_id' => 'required|exists:tours,id',
        ]);

        // Create trip
        $trip = Trip::create([
            'user_id' => $request->user_id,
            'tour_id' => $request->tour_id,
            'started_at' => now(),
            'status' => 'ongoing',
        ]);

        // get all Tour's batiments
        $batiments = Tour::find($request->tour_id)->batiments;

        // then with it create pitstop of the trip
        foreach ($batiments as $batiment) {
            TripPitstop::create([
                'trip_id' => $trip->id,
                'batiment_id' => $batiment->id,
                'status' => 'pending',
            ]);
        }

        return response()->json($trip, 201);
    }

    public function validatePitstop(Request $request): JsonResponse
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'batiment_id' => 'required|exists:batiments,id',
        ]);
        $pitstop = TripPitstop::where('trip_id', $request->trip_id)
            ->where('batiment_id', $request->batiment_id)
            ->firstOrFail();

        $pitstop->update([
            'visited_at' => now(),
            'status' => 'visited',
        ]);

        return response()->json($pitstop, 200);
    }

    public function completeTrip(Request $request): JsonResponse
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
        ]);
        $trip = Trip::with('pitstops')->findOrFail($request->trip_id);

        // Vérifier que tous les pitstops ont été visités
        if ($trip->pitstops->where('status', '!=', 'visited')->isNotEmpty()) {
            return response()->json(['message' => 'Tous les bâtiments n’ont pas encore été visités.']);
        }

        $trip->update([
            'finished_at' => now(),
            'status' => 'completed',
        ]);

        return response()->json($trip, 200);
    }
}
