<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Comment\DestroyController;
use App\Http\Controllers\Api\V1\Comment\IndexController;
use App\Http\Controllers\Api\V1\Comment\ShowController;
use App\Http\Controllers\Api\V1\Comment\StoreController;
use App\Http\Controllers\Api\V1\Comment\UpdateController;

Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
Route::get('/{comment}', ShowController::class)->name('show');
Route::patch('/{comment}', UpdateController::class)->name('update');
Route::delete('/{comment}', DestroyController::class)->name('destroy');
