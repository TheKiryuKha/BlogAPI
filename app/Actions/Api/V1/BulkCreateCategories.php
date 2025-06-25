<?php

declare(strict_types=1);

namespace App\Actions\Api\V1;

use App\Models\Category;
use DB;
use Illuminate\Support\Collection;
use App\Payloads\Api\V1\CategoryPayload;

final readonly class BulkCreateCategories
{
    /**
     * @param Collection<int, CategoryPayload> $payloads
     * @return Collection<int, Category>
     */
    public function handle(Collection $payloads): Collection
    {
        return DB::transaction(function() use($payloads) {
            return $payloads->map(
                fn(CategoryPayload $payload): Category => Category::create(
                    $payload->toArray()
                ) 
            );
        });
    }
}