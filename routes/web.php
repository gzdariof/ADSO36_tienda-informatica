<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
