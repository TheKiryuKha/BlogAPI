<?php

namespace App\Http\Controllers\Api\V1\Tag;

use App\Http\Resources\Api\V1\TagResource;
use App\Models\Tag;
use Spatie\QueryBuilder\QueryBuilder;

class ShowController
{
    public function __invoke(Tag $tag): TagResource
    {
        return new TagResource(
            resource: QueryBuilder::for(
                subject: Tag::where('id', $tag->id)
            )->allowedIncludes(['posts'])->first()
        );
    }
}
