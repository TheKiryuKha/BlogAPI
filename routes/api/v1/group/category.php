<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Category\BulkStoreController;
use App\Http\Controllers\Api\V1\Category\DestroyController;
use App\Http\Controllers\Api\V1\Category\IndexController;
use App\Http\Controllers\Api\V1\Category\ShowController;
use App\Http\Controllers\Api\V1\Category\StoreController;
use App\Http\Controllers\Api\V1\Category\UpdateController;

Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
Route::post('/bulk', BulkStoreController::class)->name('bulkStore');
Route::get('/{category}', ShowController::class)->name('show');
Route::put('/{category}', UpdateController::class)->name('update');
Route::delete('/{category}', DestroyController::class)->name('destroy');
