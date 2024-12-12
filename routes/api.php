<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MakulController;
use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/mahasiswa/create', [MahasiswaController::class, 'store']);     // Create
    Route::get('/mahasiswa/read', [MahasiswaController::class, 'index']);        // Read (all)
    Route::get('/mahasiswa/read/{mahasiswa}', [MahasiswaController::class, 'show']); // Read (single)
    Route::put('/mahasiswa/update/{mahasiswa}', [MahasiswaController::class, 'update']); // Update
    Route::delete('/mahasiswa/delete/{mahasiswa}', [MahasiswaController::class, 'destroy']); // Delete
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/dosen/create', [DosenController::class, 'store']);     // Create
    Route::get('/dosen/read', [DosenController::class, 'index']);        // Read (all)
    Route::get('/dosen/read/{dosen}', [DosenController::class, 'show']); // Read (single)
    Route::put('/dosen/update/{dosen}', [DosenController::class, 'update']); // Update
    Route::delete('/dosen/delete/{dosen}', [DosenController::class, 'destroy']); // Delete
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/makul/create', [MakulController::class, 'store']);     // Create
    Route::get('/makul/read', [MakulController::class, 'index']);        // Read (all)
    Route::get('/makul/read/{makul}', [MakulController::class, 'show']); // Read (single)
    Route::put('/makul/update/{makul}', [MakulController::class, 'update']); // Update
    Route::delete('/makul/delete/{makul}', [MakulController::class, 'destroy']); // Delete
});

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);

Route::post('/logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');