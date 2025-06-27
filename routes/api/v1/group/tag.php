<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Tag\BulkStoreController;
use App\Http\Controllers\Api\V1\Tag\DestroyController;
use App\Http\Controllers\Api\V1\Tag\IndexController;
use App\Http\Controllers\Api\V1\Tag\ShowController;
use App\Http\Controllers\Api\V1\Tag\StoreController;
use App\Http\Controllers\Api\V1\Tag\UpdateController;

Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
Route::post('/bulk', BulkStoreController::class)->name('bulkStore');
Route::get('/{tag}', ShowController::class)->name('show');
Route::put('/{tag}', UpdateController::class)->name('update');
Route::delete('/{tag}', DestroyController::class)->name('destroy');
