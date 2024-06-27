<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\marcaController;
use App\Http\Controllers\modeloController;
use App\Http\Controllers\dispositivoController;
use App\Http\Controllers\bodegaController;

Route::get('/marcas', [marcaController::class, 'listarMarcas']);
Route::post('/marcas', [marcaController::class, 'guardarMarca']);

Route::get('/modelos', [modeloController::class, 'listarModelos']);
Route::get('/modelos/marca/{nom_marca}', [modeloController::class, 'modelosPorMarca']);
Route::post('/modelos', [modeloController::class, 'guardarModelo']);

Route::get('/dispositivos', [dispositivoController::class, 'listarDispositivos']);
Route::get('/dispositivos/bodega/{bodega_id}', [dispositivoController::class, 'dispositivosPorBodega']);
Route::get('/dispositivos/modelo/{nom_modelo}', [dispositivoController::class, 'dispositivosPorModelo']);
Route::post('/dispositivos', [dispositivoController::class, 'guardarDispositivo']);


Route::get('/bodegas', [bodegaController::class, 'listarBodegas']);
Route::post('/bodegas', [bodegaController::class, 'guardarBodega']);
