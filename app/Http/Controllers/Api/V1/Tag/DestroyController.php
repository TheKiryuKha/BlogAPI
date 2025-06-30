<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Tag;

use App\Actions\Api\V1\DeleteTag;
use App\Models\Tag;
use Gate;
use Illuminate\Http\JsonResponse;

final class DestroyController
{
    public function __invoke(Tag $tag, DeleteTag $action): JsonResponse
    {
        Gate::authorize('delete', Tag::class);

        $action->handle($tag);

        return response()->json(status: 204);
    }
}
