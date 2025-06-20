<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::as('api:')->group(function () {
    Route::prefix('auth')->as('auth:')->group(base_path('routes/auth.php'));
});
