<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/**
 * Category Endpoints
 */
Route::prefix('categories')
    ->as('categories:')
    ->group(base_path('routes/api/v1/group/category.php'));

/**
 * Tags Endpoints
 */
Route::prefix('tags')
    ->as('tags:')
    ->group(base_path('routes/api/v1/group/tag.php'));

/**
 * Users Endpoints
 */
Route::prefix('users')
    ->as('users:')
    ->group(base_path('routes/api/v1/group/user.php'));

/**
 * Posts Endpoints
 */
Route::prefix('posts')
    ->as('posts:')
    ->group(base_path('routes/api/v1/group/post.php'));
