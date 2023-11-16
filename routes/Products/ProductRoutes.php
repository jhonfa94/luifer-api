<?php

use App\Http\Modules\Products\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::prefix('products')->middleware('jwt.verify')->group(function () {

    Route::post('/create', [ProductController::class, 'store']);
    Route::get('/list', [ProductController::class, 'index']);
    Route::get('/list/{id}', [ProductController::class, 'show']);
    Route::put('/update/{id}', [ProductController::class, 'update']);
});
