<?php

use App\Http\Modules\Marks\Controllers\MarkController;
use Illuminate\Support\Facades\Route;




Route::prefix('marks')->middleware('jwt.verify')->group(function () {

    Route::post('/create', [MarkController::class, 'store']);
    Route::get('/list', [MarkController::class, 'index']);
    Route::get('/list/{id}', [MarkController::class, 'show']);
    Route::put('/update/{id}', [MarkController::class, 'update']);
});
