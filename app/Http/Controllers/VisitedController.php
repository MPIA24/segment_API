<?php

namespace App\Http\Controllers;

use App\Models\Batiment;
use App\Models\VisitedBatiments;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitedController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // Validate the request data
        $request->validate([
            'batiment_id' => 'required|exists:batiments,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Create a new entry in the 'batiments_users' table
        $visitedBatiment = VisitedBatiments::create([
            'batiment_id' => $request->batiment_id,
            'user_id' => $request->user_id,
            'visited_at' => now(),
        ]);

        // Return a success response
        return response()->json([
            'message' => 'Batiment visited successfully',
            'visited_batiment' => $visitedBatiment,
        ], 201);
    }

    public function ReadAllFromUser(Request $request): JsonResponse
    {
        // Valider les données de la requête
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Récupérer les bâtiments visités avec les détails des bâtiments
        $visitedBatiments = VisitedBatiments::where('user_id', $request->user_id)
            ->get()
            ->map(function ($visited) {
                // Récupérer le bâtiment lié à cette entrée
                $batiment = Batiment::find($visited->batiment_id);

                return [
                    'batiment_id' => $visited->batiment_id,
                    'data' => [
                        'name' => $batiment->name,
                        'description' => $batiment->description,
                        'localisation' => [
                            'latitude' => $batiment->latitude,
                            'longitude' => $batiment->longitude,
                        ],
                        'visited_at' => $visited->visited_at,
                    ],
                ];
            });

        return response()->json($visitedBatiments, 200);
    }
    public function countVisit(Request $request): JsonResponse{

        $request->validate([
            'batiment_id' => 'required|exists:batiments,id',
        ]);
        $numberOfVisit = VisitedBatiments::where('batiment_id',$request->batiment_id)->get()->count();
        return response()->json([
            'batiment_id' => $request->batiment_id,
            'count_visit' => $numberOfVisit,
        ], 200) ;
    }
}
