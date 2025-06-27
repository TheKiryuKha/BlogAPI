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
                'image' => new ImageResource(
                    resource: $this->resource->getMedia()->first()
                ),
                'content' => $this->resource->content,
                'status' => $this->resource->status,
                'created' => new DateResource(
                    resource: $this->resource->created_at
                ),
            ],
            'relationships' => [
                'category' => new CategoryResource(
                    resource: $this->whenLoaded('category')
                ),
                'user' => new UserResource(
                    resource: $this->whenLoaded('user')
                ),
                'tags' => TagResource::collection(
                    resource: $this->whenLoaded('tags')
                ),
                'comments' => CommentResource::collection(
                    resource: $this->whenLoaded('comments')
                ),
            ],
            'links' => [
                'self' => route('api:v1:posts:show', $this->resource),
                'parent' => route('api:v1:posts:index'),
            ],
        ];
    }
}
