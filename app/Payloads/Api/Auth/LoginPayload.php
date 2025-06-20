<?php

declare(strict_types=1);

namespace App\Payloads\Api\Auth;

final readonly class LoginPayload
{
    public function __construct(
        private string $email,
        private string $password,
    ) {}

    /**
     * @param  array{email: string, password: string}  $data
     */
    public static function make(array $data): self
    {
        return new self(
            email: $data['email'],
            password: $data['password']
        );
    }

    /**
     * @return array{email: string, password: string}
     */
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
