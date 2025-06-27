<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Comment\IndexController;

Route::get('/', IndexController::class)->name('index');
Route::get('/{comment}', IndexController::class)->name('show');
