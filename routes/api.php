<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
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

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('profils', [ProfilController::class, 'store']);
    Route::put('profils/{profil}', [ProfilController::class, 'update']);
    Route::delete('profils/{profil}', [ProfilController::class, 'destroy']);
});

Route::get('profils', [ProfilController::class, 'index']);
Route::get('profils/{profil}', [ProfilController::class, 'show']);
