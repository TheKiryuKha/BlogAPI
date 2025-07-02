<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Tag;

use App\Http\Resources\Api\V1\TagResource;
use App\Models\Tag;
use App\Queries\FetchRealtions;

final class ShowController
{
    public function __invoke(Tag $tag, FetchRealtions $query): TagResource
    {
        $tag = $query->handle(
            query: Tag::query()->where('id', $tag->id),
            relations: ['posts']
        );

        return new TagResource(
            resource: $tag->first()
        );
    }
}
