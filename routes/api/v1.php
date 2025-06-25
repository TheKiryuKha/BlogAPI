<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Category;
use App\Http\Controllers\Api\V1\Tag;
use Illuminate\Support\Facades\Route;

/**
 * Category Endpoints
 */
Route::prefix('categories')->as('categories:')->group(function () {

    Route::get('/', Category\IndexController::class)->name('index'); 
    Route::post('/', Category\StoreController::class)->name('store'); 
    Route::post('/bulk', Category\BulkStoreController::class)->name('bulkStore'); 
    Route::get('/{category}', Category\ShowController::class)->name('show'); 
    Route::patch('/{category}', Category\UpdateController::class)->name('update'); 
    Route::delete('/{category}', Category\DestroyController::class)->name('destroy'); 
});

/**
 * Tags Endpoints
 */
Route::prefix('tags')->as('tags:')->group(function(){

    Route::get('/', Tag\IndexController::class)->name('index');
    Route::get('/{tag}', Tag\ShowController::class)->name('show');
});