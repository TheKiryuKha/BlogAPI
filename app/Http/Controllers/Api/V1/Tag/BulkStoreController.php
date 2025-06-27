<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Tag;

use App\Actions\Api\V1\BulkCreateTags;
use App\Http\Requests\Api\V1\Tag\BulkStoreRequest;
use App\Http\Resources\Api\V1\TagResource;
use App\Models\Tag;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

final class BulkStoreController
{
    public function __invoke(BulkStoreRequest $request, BulkCreateTags $action): AnonymousResourceCollection
    {
        Gate::authorize('create', Tag::class);

        return TagResource::collection(
            resource: $action->handle(
                payloads: $request->payload()
            )
        );
    }
}
