<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CatatanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - LKPD Laravel Sanctum
|--------------------------------------------------------------------------
|
| Endpoint yang tersedia:
|   POST   /api/register  - Buat akun baru (tanpa token)
|   POST   /api/login     - Login dan dapatkan token
|   GET    /api/profil    - Identitas akun aktif (butuh token)
|   POST   /api/logout    - Cabut token aktif (butuh token)
|   GET    /api/catatan   - Daftar catatan milik akun (butuh token)
|   POST   /api/catatan   - Simpan catatan baru (butuh token)
|
*/

// Endpoint publik - tidak butuh token
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Endpoint dilindungi Sanctum - butuh token Bearer
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profil',   [AuthController::class, 'profil']);
    Route::post('/logout',  [AuthController::class, 'logout']);

    Route::get('/catatan',  [CatatanController::class, 'index']);
    Route::post('/catatan', [CatatanController::class, 'store']);
});
