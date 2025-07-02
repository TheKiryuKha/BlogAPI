<?php

declare(strict_types=1);

namespace App\Queries;

use App\Queries\Contracts\FetchRelationsContract;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\QueryBuilder;

final readonly class FetchRealtions implements FetchRelationsContract
{
    public function handle(Builder $query, array $relations): Builder
    {
        return QueryBuilder::for(
            subject: $query
        )->allowedIncludes(
            includes: $relations
        )->getEloquentBuilder();
    }
}
