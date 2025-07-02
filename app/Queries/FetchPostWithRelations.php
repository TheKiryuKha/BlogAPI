<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\QueryBuilder;

final readonly class FetchPostWithRelations
{
    /**
     * @param  Builder<Post>  $query
     * @return Builder<Post>
     */
    public function handle(Builder $query): Builder
    {
        return QueryBuilder::for(
            subject: $query
        )->allowedIncludes(
            includes: ['user', 'category', 'tags', 'comments']
        )->getEloquentBuilder();
    }
}
