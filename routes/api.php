<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\PacketController;
use App\Http\Controllers\AiPredictionController;
use App\Models\AiPrediction;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/stats', [StatsController::class, 'index']);

Route::get('/packets', [PacketController::class, 'index']);;

// Route::get('/ai-predictions', function () {
//     return AiPrediction::all();
// });

Route::get('/ai-predictions', [AiPredictionController::class, 'predict']);
