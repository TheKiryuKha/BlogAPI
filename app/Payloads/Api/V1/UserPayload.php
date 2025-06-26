<?php

declare(strict_types=1);

namespace App\Payloads\Api\V1;

use App\Enums\UserRole;
use Illuminate\Http\UploadedFile;

final readonly class UserPayload
{
    public function __construct(
        private string $name,
        private UserRole $role,
        private string $description,
        private ?UploadedFile $avatar = null,
    ) {}

    /**
     * @param  array{name: string, role: UserRole, description: string, avatar: UploadedFile|null}  $data
     */
    public static function make(array $data): self
    {
        return new self(
            name: $data['name'],
            role: $data['role'],
            description: $data['description'],
            avatar: $data['avatar']
        );
    }

    /**
     * @return array{description: string, name: string, role: UserRole}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'role' => $this->role,
            'description' => $this->description,
        ];
    }

    public function getAvatar(): ?UploadedFile
    {
        return $this->avatar;
    }
}
