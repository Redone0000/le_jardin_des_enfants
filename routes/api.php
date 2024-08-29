<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PartnerController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('partners', [PartnerController::class, 'index']);
    Route::get('partners/{id}', [PartnerController::class, 'show']);
    Route::post('partners', [PartnerController::class, 'store']);
    Route::put('partners/{id}', [PartnerController::class, 'update']);
    Route::delete('partners/{id}', [PartnerController::class, 'destroy']);
});