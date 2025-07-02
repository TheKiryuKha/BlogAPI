<?php

declare(strict_types=1);

namespace App\Queries;

use App\Queries\Contracts\PostQueryContract;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final readonly class PostQuery implements PostQueryContract
{
    public function handle(Builder $query): Builder
    {
        return QueryBuilder::for(
            subject: $query
        )->allowedIncludes(
            includes: ['user', 'category', 'tags', 'comments']
        )->allowedFilters([
            AllowedFilter::exact('status'),
        ])->getEloquentBuilder();
    }
}
