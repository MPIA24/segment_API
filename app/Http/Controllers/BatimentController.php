<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batiment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BatimentController extends Controller
{
    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimetypes:application/json',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid file format.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $file = $request->file('file');
        $jsonData = json_decode(file_get_contents($file), true);

        if (!$jsonData || !is_array($jsonData)) {
            return response()->json(['message' => 'Invalid JSON structure.'], 400);
        }

        $batiments = [];
        foreach ($jsonData as $entry) {
            $validator = Validator::make($entry, [
                'id' => 'required|string|unique:batiments,id',
                'data.name' => 'required|string',
                'data.description' => 'nullable|string',
                'data.localisation.latitude' => 'required|numeric',
                'data.localisation.longitude' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error for an entry.',
                    'errors' => $validator->errors(),
                    'entry' => $entry,
                ], 422);
            }

            $batiments[] = Batiment::create([
                'id' => $entry['id'],
                'name' => $entry['data']['name'],
                'description' => $entry['data']['description'] ?? null,
                'latitude' => $entry['data']['localisation']['latitude'],
                'longitude' => $entry['data']['localisation']['longitude'],
            ]);
        }

        return response()->json([
            'message' => 'Bâtiments importés avec succès.',
            'batiments' => $batiments,
        ], 201);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $batiment = Batiment::create([
            'id' => Str::uuid(),
            'name' => $request->input('name'),
            'description' => $request->input('description', null),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return response()->json([
            'message' => 'Bâtiment créé avec succès.',
            'batiment' => $batiment,
        ], 201);
    }

    public function destroy($id)
    {
        $batiment = Batiment::find($id);

        if (!$batiment) {
            return response()->json([
                'message' => 'Bâtiment non trouvé.',
            ], 404);
        }
        $batiment->delete();

        return response()->json([
            'message' => 'Bâtiment supprimé avec succès.',
            'batiment_id' => $id,
        ], 200);
    }
    public function index()
    {
        $batiments = Batiment::all();

        return response()->json([
            'message' => 'Liste des bâtiments récupérée avec succès.',
            'batiments' => $batiments,
        ], 200);
    }
    public function show($id)
    {
        $batiment = Batiment::find($id);

        if (!$batiment) {
            return response()->json([
                'message' => 'Bâtiment non trouvé.',
            ], 404);
        }

        return response()->json([
            'message' => 'Bâtiment récupéré avec succès.',
            'batiment' => $batiment,
        ], 200);
    }
}

