<?php

namespace App\Http\Controllers;

use App\Models\Batiment;
use App\Models\VisitedBatiments;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function countVisitsForAll(): JsonResponse
    {
        $visits = VisitedBatiments::select('batiment_id', DB::raw('COUNT(*) as count_visit'))
            ->groupBy('batiment_id')
            ->get();


        $response = $visits->map(function ($visit) {
            return [
                'batiment_id' => $visit->batiment_id,
                'count_visit' => $visit->count_visit,
            ];
        });

        return response()->json($response, 200);
    }

public function countVisitsOfVisitedPOI(): JsonResponse
    {
        $visits = Batiment::leftJoin('batiments_users', 'batiments.id', '=', 'batiments_users.batiment_id')
        ->select('batiments.id as batiment_id', DB::raw('COUNT(batiments_users.id) as count_visit'))
        ->groupBy('batiments.id')
        ->get();

    // Construire la réponse
    $response = $visits->map(function ($visit) {
        return [
            'batiment_id' => $visit->batiment_id,
            'count_visit' => $visit->count_visit,
        ];
    });

    return response()->json($response, 200);
    }
}
