<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Post\DestroyController;
use App\Http\Controllers\Api\V1\Post\IndexController;
use App\Http\Controllers\Api\V1\Post\ShowController;
use App\Http\Controllers\Api\V1\Post\StoreController;
use App\Http\Controllers\Api\V1\Post\UpdateController;

Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
Route::get('/{post}', ShowController::class)->name('show');
Route::patch('/{post}', UpdateController::class)->name('update');
Route::delete('/{post}', DestroyController::class)->name('destroy');
