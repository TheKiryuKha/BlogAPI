<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\User\DestroyController;
use App\Http\Controllers\Api\V1\User\IndexController;
use App\Http\Controllers\Api\V1\User\ShowController;
use App\Http\Controllers\Api\V1\User\UpdateController;
use App\Http\Controllers\Api\V1\User\UpdateRoleController;

Route::get('/', IndexController::class)->name('index');

Route::get('/{user}', ShowController::class)->name('show');
Route::put('/{user}', UpdateController::class)->name('update');
Route::patch('/{user}', UpdateRoleController::class)->name('updateRole');
Route::delete('/{user}', DestroyController::class)->name('destroy');
