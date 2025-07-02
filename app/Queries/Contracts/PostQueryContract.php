<?php

declare(strict_types=1);

namespace App\Queries\Contracts;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

interface PostQueryContract
{
    /**
     * @param  Builder<Post>  $query
     * @return Builder<Post>
     */
    public function handle(Builder $query): Builder;
}
