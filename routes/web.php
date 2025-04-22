<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    //return redirect('/admin/login');
});

Route::get('/metricas/create', [MetricaSesionController::class, 'create'])->name('metricas.create');
Route::post('/metricas/store', [MetricaSesionController::class, 'store'])->name('metricas.store');

