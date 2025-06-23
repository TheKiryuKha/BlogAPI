<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Category $resource
 */
final class CategoryResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'type' => 'category',
            'attributes' => [
                'title' => $this->resource->title,
                'created' => new DateResource(
                    resource: $this->resource->created_at
                ),
            ],
            'relationships' => [],
            'links' => [
                'self' => route('api:v1:categories:show', $this->resource->id),
                'parent' => route('api:v1:categories:index'),
            ],
        ];
    }
}
