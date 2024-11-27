<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BatimentController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\VisitedController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['post'],base_path('routes/api/auth.php'));

//POI routes
Route::post('/batiments/import', [BatimentController::class, 'import']);
Route::post('/batiments', [BatimentController::class, 'store']);
Route::delete('/batiments/{id}', [BatimentController::class, 'destroy']);
Route::get('/batiments', [BatimentController::class, 'index']);
Route::get('/batiments/{id}', [BatimentController::class, 'show']);

//visited routes
Route::post('/visited',[VisitedController::class,'store']);
Route::get('/visited',[VisitedController::class,'ReadAllFromUser']);
Route::get('/visited/count',[VisitedController::class,'countVisit']);


//tour routes
Route::post('/tours', [TourController::class, 'store']);
Route::get('/tours', [TourController::class, 'index']);
Route::get('/tours/details', [TourController::class, 'show']);

//trip routes
Route::post('/trips/start', [TripController::class,'startTrip']);
Route::post('/trips/pitstop/validate', [TripController::class,'validatePitstop']);
Route::post('/trips/complete', [TripController::class,'completeTrip']);


