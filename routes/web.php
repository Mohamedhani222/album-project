<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('albums.index');
    });
    Route::resource('albums', AlbumController::class);
    Route::post('/image/destroy', [ImageController::class,'destroy'])->name('images.destroy');
    Route::post('/image', [ImageController::class,'store'])->name('images.store');
});


require __DIR__ . '/auth.php';
