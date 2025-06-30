<?php

declare(strict_types=1);

namespace App\Payloads\Api\V1;

final readonly class CommentPayload
{
    public function __construct(
        private int $user_id,
        private int $post_id,
        private string $text
    ) {}

    /**
     * @param  array{user_id: int, post_id: int, text: string}  $data
     */
    public static function make(array $data): self
    {
        return new self(
            user_id: $data['user_id'],
            post_id: $data['post_id'],
            text: $data['text']
        );
    }

    /**
     * @return array{post_id: int, text: string, user_id: int}
     */
    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'post_id' => $this->post_id,
            'text' => $this->text,
        ];
    }
}
