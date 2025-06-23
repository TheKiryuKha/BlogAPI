<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Category\IndexController;
use App\Http\Controllers\Api\V1\Category\ShowController;
use Illuminate\Support\Facades\Route;

/**
 * Category Endpoints
 */
Route::prefix('categories')->as('categories:')->group(function () {

    Route::get('/', IndexController::class)->name('index');
    Route::get('/{categories}', ShowController::class)->name('show');
});
