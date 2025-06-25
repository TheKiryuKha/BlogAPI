<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Category\IndexController;
use App\Http\Controllers\Api\V1\Category\ShowController;
use App\Http\Controllers\Api\V1\Category\StoreController;
use Illuminate\Support\Facades\Route;

/**
 * Category Endpoints
 */
Route::prefix('categories')->as('categories:')->group(function () {

    Route::get('/', IndexController::class)->name('index'); // api:v1:categories:index
    Route::post('/', StoreController::class)->name('store'); // api:v1:categories:store
    Route::get('/{category}', ShowController::class)->name('show'); // api:v1:categories:show
});
