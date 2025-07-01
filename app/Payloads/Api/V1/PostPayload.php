<?php

declare(strict_types=1);

namespace App\Payloads\Api\V1;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

final readonly class PostPayload
{
    public function __construct(
        private int $user_id,
        private int $category_id,
        private string $title,
        private string $content,
        private PostStatus $status,
        private ?UploadedFile $image = null,
        private ?array $tags = null
    ) {}

    /**
     * @param array{
     * user_id: int,
     * category_id: int,
     * title: string,
     * content: string,
     * status: PostStatus,
     * image: UploadedFile|null,
     * tags: array<int>|null
     * } $data
     */
    public static function make(array $data): self
    {
        return new self(
            user_id: $data['user_id'],
            category_id: $data['category_id'],
            title: $data['title'],
            content: $data['content'],
            status: $data['status'],
            image: $data['image'],
            tags: $data['tags']
        );
    }

    /**
     * @return array{category_id: int, content: string, status: PostStatus, title: string, user_id: int}
     */
    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
        ];
    }

    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }

    public function getTags(): Collection
    {
        return collect($this->tags);
    }
}
