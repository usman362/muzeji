<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('exhibitions/{id}',[App\Http\Controllers\ProjectController::class,'index'])->name('projects.index');

Route::post('projects',[App\Http\Controllers\ProjectController::class,'store'])->name('projects.store');

Route::get('poi/{id}',[App\Http\Controllers\ProjectController::class,'poiIndex'])->name('poi.index');

Route::post('poi/{id}',[App\Http\Controllers\ProjectController::class,'poiStore'])->name('poi.store');

Route::delete('poi/{id}',[App\Http\Controllers\ProjectController::class,'poiDestroy'])->name('poi.destroy');

Route::get('poi-details/{id}',[App\Http\Controllers\ProjectController::class,'poiShow'])->name('poi.show');

Route::post('exhibitions/{id}',[App\Http\Controllers\ProjectController::class,'exhibitionStore'])->name('exhibition.store');

Route::get('settings',[App\Http\Controllers\SettingsController::class,'index'])->name('settings.index');

Route::get('statistics',[App\Http\Controllers\SettingsController::class,'statistics'])->name('settings.statistics');


