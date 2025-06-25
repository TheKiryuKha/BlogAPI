<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Tag;

use App\Http\Requests\Api\V1\Tag\UpdateRequest;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

final class UpdateController
{
    public function __invoke(Tag $tag, UpdateRequest $request): JsonResponse
    {
        $tag->update(
            $request->payload()->toArray()
        );

        return response()->json(
            data: [
                'message' => 'Tag updated succesfully',
            ], status: 200
        );
    }
}
