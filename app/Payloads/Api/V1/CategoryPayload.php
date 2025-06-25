<?php

declare(strict_types=1);

namespace App\Payloads\Api\V1;

final readonly class CategoryPayload
{
    public function __construct(
        private string $title
    ) {}

    /**
     * @param  array{title: string}  $data
     */
    public static function make(array $data): self
    {
        return new self(
            title: $data['title']
        );
    }

    /**
     * @return array{title: string}
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
        ];
    }
}
