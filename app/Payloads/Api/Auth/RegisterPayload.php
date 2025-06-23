<?php

declare(strict_types=1);

namespace App\Payloads\Api\Auth;

use App\Enums\UserRole;

final readonly class RegisterPayload
{
    public function __construct(
        private string $name,
        private UserRole $role,
        private string $email,
        private string $password
    ) {}

    /** @param array{email: string, name: string, password: string} $data */
    public static function make(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            role: UserRole::Reader
        );
    }

    /** @return array{email: string, name: string, password: string, role: UserRole} */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'role' => $this->role,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
