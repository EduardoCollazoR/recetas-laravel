<?php

use App\Http\Controllers\CategoriasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CateogoriasController;
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

Route::get('/', [InicioController::class, "index"])->name('inicio.index');

Route::get('/recetas', [RecetaController::class, "index"])->name('recetas.index');

Route::get('/recetas/create', [RecetaController::class, "create"])->name('recetas.create');

Route::post('/recetas', [RecetaController::class, "store"])->name('recetas.store');

Route::get('/recetas/{receta}', [RecetaController::class, "show"])->name('recetas.show');

Route::get('/recetas/{receta}/edit', [RecetaController::class, "edit"])->name('recetas.edit');

Route::put('/recetas/{receta}', [RecetaController::class, "update"])->name('recetas.update');

Route::delete('/recetas/{receta}', [RecetaController::class, "destroy"])->name('recetas.destroy');

Route::get('/categoria/{categoriaReceta}', [CategoriasController::class, "show"])->name('categorias.show');


/* Route::resource('recetas', RecetaController::class); */

//buscador de recetas 

Route::get('/buscar', [RecetaController::class, "search"])->name('buscar.show');


Route::get('/perfiles/{perfil}', [PerfilController::class, "show"])->name('perfiles.show');


Route::get('/perfiles/{perfil}/edit', [PerfilController::class, "edit"])->name('perfiles.edit');

Route::put('/perfiles/{perfil}', [PerfilController::class, "update"])->name('perfiles.update');


//almacena los likes de las recetas 
Route::post('/recetas/{receta}', [LikesController::class, "store"])->name('likes.store');

Auth::routes();

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */
