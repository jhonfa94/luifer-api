<?php

use App\Http\Modules\Categories\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;



Route::prefix('categories')->middleware('jwt.verify')->group(function () {

    Route::post('/create', [CategoryController::class,'store']);
    Route::get('/list', [CategoryController::class,'index']);
    Route::get('/list/{id}', [CategoryController::class,'show']);
    Route::put('/update/{id}', [CategoryController::class,'update']);

});
