<?php

declare(strict_types=1);

namespace App\Queries;

use App\Queries\Contracts\UserQueryContract;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final readonly class UserQuery implements UserQueryContract
{
    public function handle(Builder $query): Builder
    {
        return QueryBuilder::for(
            subject: $query
        )->allowedIncludes(
            includes: ['posts', 'comments']
        )->allowedFilters([
            AllowedFilter::exact('role'),
        ])->getEloquentBuilder();
    }
}
