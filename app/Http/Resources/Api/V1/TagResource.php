<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Tag;

/**
 * @property-read Tag $resource
 */
class TagResource extends JsonResource
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
            'type' => 'tag',
            'attributes' => [
                'title' => $this->resource->title,
                'created' => new DateResource(
                    resource: $this->resource->created_at
                )
            ],
            'relationships' => [
                'posts' => PostResource::collection(
                    resource: $this->whenLoaded('posts')
                )
            ],
            'links' => [
                'self' => 'todo',
                'parent' => route('api:v1:tags:index')
            ]
        ];
    }
}
