<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VideoController;
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

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);

            
        Route::post('/videos/upload', [VideoController::class, 'upload']);
        Route::get('/videos/signed-url', [VideoController::class, 'getSignedUrl']);
        Route::get('/videos/url', [VideoController::class, 'getUrl']);
        Route::post('videos/{id}/upload', [VideoController::class, 'upload']);

        Route::prefix('videos')->group(function () {
            Route::get('/', [VideoController::class, 'index']);      // Listar vídeos
            Route::get('{id}', [VideoController::class, 'show']);    // Ver um vídeo
            Route::post('/', [VideoController::class, 'store']);     // Criar vídeo
            Route::put('{id}', [VideoController::class, 'update']);  // Atualizar vídeo
            Route::delete('{id}', [VideoController::class, 'destroy']); // Deletar vídeo
        });

    });
});

