<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Tag;

use App\Http\Requests\Api\V1\Tag\UpdateRequest;
use App\Http\Resources\Api\V1\TagResource;
use App\Models\Tag;
use Illuminate\Support\Facades\Gate;

final class UpdateController
{
    public function __invoke(Tag $tag, UpdateRequest $request): TagResource
    {
        Gate::authorize('update', Tag::class);

        $tag->update(
            $request->payload()->toArray()
        );

        return new TagResource($tag);
    }
}
