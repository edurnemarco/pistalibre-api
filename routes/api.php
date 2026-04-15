<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConvocatoriaController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\AlertaController;
use App\Http\Controllers\ParticipacionController;
use App\Http\Controllers\AdminController;

// Rutas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/convocatorias', [ConvocatoriaController::class, 'index']);
Route::get('/convocatorias/{id}', [ConvocatoriaController::class, 'show']);
Route::get('/instituciones', [InstitucionController::class, 'index']);
Route::get('/instituciones/{id}', [InstitucionController::class, 'show']);

// Rutas protegidas (requieren login)
Route::middleware('auth:sanctum')->group(function () {

    // Autenticación
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Favoritos
    Route::get('/favoritos', [FavoritoController::class, 'index']);
    Route::post('/favoritos', [FavoritoController::class, 'store']);
    Route::delete('/favoritos/{id}', [FavoritoController::class, 'destroy']);

    // Alertas
    Route::get('/alertas', [AlertaController::class, 'index']);
    Route::post('/alertas', [AlertaController::class, 'store']);
    Route::delete('/alertas/{id}', [AlertaController::class, 'destroy']);

    // Participaciones
    Route::get('/participaciones', [ParticipacionController::class, 'index']);
    Route::post('/participaciones', [ParticipacionController::class, 'store']);
    Route::put('/participaciones/{id}', [ParticipacionController::class, 'update']);
    Route::delete('/participaciones/{id}', [ParticipacionController::class, 'destroy']);

    // Institución
    Route::put('/instituciones/{id}', [InstitucionController::class, 'update']);
    Route::post('/convocatorias', [ConvocatoriaController::class, 'store']);
    Route::put('/convocatorias/{id}', [ConvocatoriaController::class, 'update']);
    Route::delete('/convocatorias/{id}', [ConvocatoriaController::class, 'destroy']);

    // Admin
    Route::middleware('es_admin')->group(function () {
        Route::get('/admin/pendientes', [AdminController::class, 'pendientes']);
        Route::post('/admin/scraping/importar', [AdminController::class, 'importar']);
        Route::put('/admin/convocatorias/{id}/aprobar', [AdminController::class, 'aprobar']);
        Route::put('/admin/convocatorias/{id}/rechazar', [AdminController::class, 'rechazar']);
        Route::post('/admin/convocatorias', [AdminController::class, 'store']);
        Route::get('/admin/usuarios', [AdminController::class, 'usuarios']);
        Route::put('/admin/usuarios/{id}/desactivar', [AdminController::class, 'desactivar']);
    });
});