<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Post $resource
 */
final class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'type' => 'post',
            'attributes' => [
                'title' => $this->resource->title,
                'slug' => $this->resource->slug,
                'content' => $this->resource->content,
                'status' => $this->resource->status,
                'created' => new DateResource(
                    $this->resource->created_at
                ),
            ],
            'relationships' => [],
            'links' => [
                // todo
            ],
        ];
    }
}
