<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('api')->as('api:')->middleware('auth:sanctum')->group(function () {
    /**
     * Auth
     */
    Route::prefix('auth')
        ->as('auth:')
        ->group(base_path('routes/api/auth.php'));

    /**
     * V1
     */
    Route::prefix('v1')
        ->as('v1:')
        ->group(base_path('routes/api/v1/v1.php'));
});
