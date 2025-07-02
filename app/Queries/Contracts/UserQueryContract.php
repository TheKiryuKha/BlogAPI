<?php

declare(strict_types=1);

namespace App\Queries\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

interface UserQueryContract
{
    /**
     * @param  Builder<User>  $query
     * @return Builder<User>
     */
    public function handle(Builder $query): Builder;
}
