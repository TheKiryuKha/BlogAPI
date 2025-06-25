<?php

namespace App\Http\Controllers\Api\V1\Tag;

use App\Http\Resources\Api\V1\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;

class IndexController
{
    public function __invoke(): AnonymousResourceCollection
    {
        return TagResource::collection(
            resource: QueryBuilder::for(
                subject: Tag::class
            )->allowedIncludes(['posts'])->paginate(10)
        );
    }
}
