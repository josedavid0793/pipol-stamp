<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\DescuentosController;
use App\Http\Controllers\TallasController;
use App\Http\Controllers\EstilosController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\GenerosController;
use App\Http\Controllers\CategoriasController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/productos',[ProductosController::class, 'index']);
Route::post('/productos',[ProductosController::class, 'store']);
Route::get('/productos/{id}',[ProductosController::class, 'show']);
Route::put('/productos/{id}',[ProductosController::class, 'update']);
Route::delete('/productos/{id}',[ProductosController::class, 'destroy']);

/*rutas descuentos*/
Route::get('/descuentos',[DescuentosController::class, 'index']);
Route::post('/descuentos',[DescuentosController::class, 'store']);
Route::get('/descuentos/{id}',[DescuentosController::class, 'show']);
Route::put('/descuentos/{id}',[DescuentosController::class, 'update']);
Route::delete('/descuentos/{id}',[DescuentosController::class, 'destroy']);
/*rutas tallas*/
Route::get('/tallas',[TallasController::class, 'index']);
Route::post('/tallas',[TallasController::class, 'store']);
Route::get('/tallas/{id}',[TallasController::class, 'show']);
Route::put('/tallas/{id}',[TallasController::class, 'update']);
Route::delete('/tallas/{id}',[TallasController::class, 'destroy']);
/*rutas estilos*/
Route::get('/estilos',[EstilosController::class, 'index']);
Route::post('/estilos',[EstilosController::class, 'store']);
Route::get('/estilos/{id}',[EstilosController::class, 'show']);
Route::put('/estilos/{id}',[EstilosController::class, 'update']);
Route::delete('/estilos/{id}',[EstilosController::class, 'destroy']);
/*rutas marcas*/
Route::get('/marcas',[MarcasController::class, 'index']);
Route::post('/marcas',[MarcasController::class, 'store']);
Route::get('/marcas/{id}',[MarcasController::class, 'show']);
Route::put('/marcas/{id}',[MarcasController::class, 'update']);
Route::delete('/marcas/{id}',[MarcasController::class, 'destroy']);
/*rutas marcas*/
Route::get('/colores',[ColorController::class, 'index']);
Route::post('/colores',[ColorController::class, 'store']);
Route::get('/colores/{id}',[ColorController::class, 'show']);
Route::put('/colores/{id}',[ColorController::class, 'update']);
Route::delete('/colores/{id}',[ColorController::class, 'destroy']);

/*rutas generos*/
Route::get('/generos',[GenerosController::class, 'index']);
Route::post('/generos',[GenerosController::class, 'store']);
Route::get('/generos/{id}',[GenerosController::class, 'show']);
Route::put('/generos/{id}',[GenerosController::class, 'update']);
Route::delete('/generos/{id}',[GenerosController::class, 'destroy']);

/*rutas categorias*/
Route::get('/categorias',[CategoriasController::class, 'index']);
Route::post('/categorias',[CategoriasController::class, 'store']);
Route::get('/categorias/{id}',[CategoriasController::class, 'show']);
Route::put('/categorias/{id}',[CategoriasController::class, 'update']);
Route::delete('/categorias/{id}',[CategoriasController::class, 'destroy']);
