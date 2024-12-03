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
Route::get('/count/batiments', [BatimentController::class,'count']);

//visited routes
Route::post('/visited',[VisitedController::class,'store']);
Route::post('/visited/get',[VisitedController::class,'ReadAllFromUser']);
Route::get('/count/visits',[VisitedController::class,'count']);
Route::get('/visited/count',[VisitedController::class,'countVisit']);
Route::get('/visited/count/visited', [VisitedController::class,'countVisitsForAll']);
Route::get('/visited/count/all', [VisitedController::class,'countVisitsOfVisitedPOI']);


//tour routes
Route::post('/tours', [TourController::class, 'store']);
Route::get('/tours', [TourController::class, 'index']);
Route::post('/tours/details/get', [TourController::class, 'show']);
Route::delete('/tours', [TourController::class, 'destroy']);

//trip routes
Route::post('/trips/start', [TripController::class,'startTrip']);
Route::post('/trips/pitstop/validate', [TripController::class,'validatePitstop']);
Route::post('/trips/complete', [TripController::class,'completeTrip']);
