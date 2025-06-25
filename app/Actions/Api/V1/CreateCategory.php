<?php

declare(strict_types=1);

namespace App\Actions\Api\V1;

use App\Models\Category;
use App\Payloads\Api\V1\CategoryPayload;
use DB;

final class CreateCategory
{
    public function handle(CategoryPayload $payload): Category
    {
        return DB::transaction(fn () => Category::create($payload->toArray()));
    }
}
