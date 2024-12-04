<?php

namespace App\Http\Controllers;

use App\Models\Batiment;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $batimentIds = $request->input('batiments_id');

        //check if batiments exists
        $batiments = Batiment::whereIn('id', $batimentIds)->pluck('name', 'id');
        if ($batiments->isEmpty()) {
            return response()->json(['message' => 'Aucun bâtiment trouvé pour les IDs fournis.'], 404);
        }

        // Create Tour
        $tour = Tour::create([
            'name' => $request->input('name'),
            'user_id' => $request->input('user_id'),
            'adviced_locomotion' => $request->input('adviced_locomotion'),
        ]);

        // associate batiments to tour in switch table
        $tour->batiments()->attach($batimentIds);

        // formate response in json format
        $response = [
            'tour' => [
                'id' => $tour->id,
                'name' => $tour->name,
                'distance' => $tour->distance,
                'adviced_locomotion' => $tour->adviced_locomotion,
                'batiments' => $batiments->map(function ($name, $id) {
                    return [
                        'id' => $id,
                        'name' => $name,
                    ];
                })->values(),
            ],
        ];

        return response()->json($response, 201);
    }

    public function index(): JsonResponse
    {
        $tours = Tour::with('batiments')->get();

        return response()->json([
            'tours' => $tours->map(function ($tour) {
                $user = User::where('id',$tour->user_id)->first();
                return [
                    'id' => $tour->id,
                    'author' => $user->name,
                    'name' => $tour->name,
                    'distance' => $tour->distance,
                    'adviced_locomotion' => $tour->adviced_locomotion,
                    'batiments' => $tour->batiments->map(function ($batiment) {
                        return [
                            'id' => $batiment->id,
                            'name' => $batiment->name,
                            'longitude'=>$batiment->longitude,
                            'latitude'=>$batiment->latitude,
                        ];
                    })->values(),
                ];
            })->values(),
        ], 200);
    }

    public function destroy(Request $request): JsonResponse
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
        ]);

        $tour = Tour::find($request->tour_id);
        if (!$tour) {
            return response()->json(['message' => 'Tour not found.'], 404);
        }

        $tour->batiments()->detach(); // detach all batiments associated with the tour
        $tour->delete();

        return response()->json(['message' => 'Tour deleted successfully.'], 200);
    }

    public function show (Request $request):JsonResponse
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
        ]);

        $tour = Tour::with('batiments')->where('id', $request->tour_id)->first();

        if (!$tour) {
            return response()->json(['message' => 'Tour not found.'], 404);
        }

        $user = User::where('id',$tour->user_id)->first();

        return response()->json([
            'tour' => [
                'id' => $tour->id,
                'author' => $user->name,
                'name' => $tour->name,
                'distance' => $tour->distance,
                'adviced_locomotion' => $tour->adviced_locomotion,
                'created_at' => $tour->created_at,
                'batiments' => $tour->batiments->map(function ($batiment) {
                    return [
                        'id' => $batiment->id,
                        'name' => $batiment->name,
                        'longitude'=>$batiment->longitude,
                        'latitude'=>$batiment->latitude,
                    ];
                })->values()
            ],200
        ]);
    }
}
