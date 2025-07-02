<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Tag;

use App\Http\Resources\Api\V1\TagResource;
use App\Models\Tag;
use App\Queries\Contracts\FetchRelationsContract;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class IndexController
{
    public function __invoke(FetchRelationsContract $query): AnonymousResourceCollection
    {
        $tags = $query->handle(
            query: Tag::query(),
            relations: ['posts']
        );

        return TagResource::collection(
            resource: $tags->paginate(10)
        );
    }
}
