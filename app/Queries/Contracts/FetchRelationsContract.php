<?php

declare(strict_types=1);

namespace App\Queries\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface FetchRelationsContract
{
    /**
     * @template TModel of \Illuminate\Database\Eloquent\Model
     *
     * @param  Builder<TModel>  $query
     * @param  array<string>  $relations
     * @return Builder<TModel>
     */
    public function handle(Builder $query, array $relations): Builder;
}
