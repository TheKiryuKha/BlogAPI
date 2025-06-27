<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Comment $resource
 */
final class CommentResource extends JsonResource
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
            'type' => 'comment',
            'attributes' => [
                'text' => $this->resource->text,
            ],
            'relationships' => [
                'user' => new UserResource(
                    resource: $this->whenLoaded('user')
                ),
                'post' => new PostResource(
                    resource: $this->whenLoaded('post')
                ),
            ],
            'links' => [
                'self' => route('api:v1:comments:show', $this->resource),
                'parent' => route('api:v1:comments:index'),
            ],
        ];
    }
}
