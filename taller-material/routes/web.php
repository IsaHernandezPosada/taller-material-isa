<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;

// MATERIAL ROUTES
Route::get('/', [MaterialController::class, 'index'])->name('material.index');
Route::get('/materials/create', [MaterialController::class, 'create'])->name('material.create');
Route::post('/materials', [MaterialController::class, 'save'])->name('material.save');
Route::get('/materials', [MaterialController::class, 'list'])->name('material.list');
Route::get('/materials/{id}', [MaterialController::class, 'show'])->name('material.show');
Route::delete('/materials/{id}', [MaterialController::class, 'destroy'])->name('material.destroy');