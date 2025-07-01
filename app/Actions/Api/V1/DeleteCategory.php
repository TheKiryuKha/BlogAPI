<?php

declare(strict_types=1);

namespace App\Actions\Api\V1;

use App\Models\Category;
use DB;

final readonly class DeleteCategory
{
    public function handle(Category $category): bool
    {
        return DB::transaction(function () use ($category): true {
            $category->posts()->update(['category_id' => 1]);
            $category->delete();

            return true;
        });
    }
}
