<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('poi/{id}/viewpoint/{qrcode?}',[App\Http\Controllers\ProjectController::class,'poiShow'])->name('poi.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('exhibitions/{id}',[App\Http\Controllers\ProjectController::class,'index'])->name('projects.index');

    Route::post('projects',[App\Http\Controllers\ProjectController::class,'store'])->name('projects.store');

    Route::get('poi/{id}',[App\Http\Controllers\ProjectController::class,'poiIndex'])->name('poi.index');

    Route::post('poi/{id}',[App\Http\Controllers\ProjectController::class,'poiStore'])->name('poi.store');

    Route::delete('poi/{id}',[App\Http\Controllers\ProjectController::class,'poiDestroy'])->name('poi.destroy');

    Route::get('poi/{id}/edit',[App\Http\Controllers\ProjectController::class,'poiEdit'])->name('poi.edit');

    Route::post('poi/{id}/update',[App\Http\Controllers\ProjectController::class,'poiUpdate'])->name('poi.update');

    Route::get('poi/{short_code}/qr-code/{qrcode}',[App\Http\Controllers\ProjectController::class,'qrcode_download'])->name('qrcode.download');

    Route::post('exhibitions/{id}',[App\Http\Controllers\ProjectController::class,'exhibitionStore'])->name('exhibition.store');

    Route::get('settings',[App\Http\Controllers\SettingsController::class,'index'])->name('settings.index');
    Route::post('settings/{id?}',[App\Http\Controllers\SettingsController::class,'store'])->name('settings.store');

    Route::get('statistics',[App\Http\Controllers\SettingsController::class,'statistics'])->name('settings.statistics');
});
