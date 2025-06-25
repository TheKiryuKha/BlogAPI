<?php

declare(strict_types=1);

namespace App\Actions\Api\V1;

use App\Models\Tag;
use DB;

final readonly class DeleteTag
{
    public function handle(Tag $tag): void
    {
        DB::transaction(function () use ($tag): void {
            $tag->posts()->detach();
            $tag->delete();
        });
    }
}
