<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\CameraController;
use App\Http\Controllers\Api\CameraVideoController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\StreamingController;
use App\Http\Controllers\Api\ListEventsController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);        

        Route::apiResource('genres', GenreController::class);

        Route::apiResource('events', EventController::class);
        Route::apiResource('cameras', CameraController::class);
        Route::apiResource('camera-videos', CameraVideoController::class);

        Route::post('uploads/initiate', [UploadController::class, 'initiateUpload']);

        Route::get('/streaming/url', [StreamingController::class, 'getStreamingUrl']);

        Route::get('/events', [ListEventsController::class, 'index']);

    });


