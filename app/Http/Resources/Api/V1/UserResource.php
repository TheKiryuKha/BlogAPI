<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read User $resource
 */
final class UserResource extends JsonResource
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
            'type' => 'user',
            'attributes' => [
                'name' => $this->resource->name,
                'avatar' => new ImageResource(
                    resource: $this->resource->getMedia()->first()
                ),
                'role' => $this->resource->role,
                'description' => $this->resource->description,
                'email' => $this->resource->email,
                'created' => new DateResource(
                    resource: $this->resource->created_at
                ),
            ],
            'relationships' => [
                'posts' => PostResource::collection(
                    resource: $this->whenLoaded('posts')
                ),
                'comments' => CommentResource::collection(
                    resource: $this->whenLoaded('comments')
                ),
            ],
            'links' => [
                'self' => route('api:v1:users:show', $this->resource),
                'parent' => route('api:v1:users:index'),
            ],
        ];
    }
}
