<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Models\User;
use App\Payloads\Api\Auth\RegisterPayload;
use App\Services\Api\Auth\RegisterService;

it('register user and creates token for him', function () {
    $service = app(RegisterService::class);
    $payload = RegisterPayload::make([
        'name' => 'test',
        'email' => 'test@gmail.com',
        'role' => UserRole::Reader,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $service->register($payload);
    $token = $service->createToken();

    expect(User::first())
        ->name->toBe('test')
        ->email->toBe('test@gmail.com')
        ->role->toBe(UserRole::Reader);

    $this->assertTrue($token->accessToken->can('reader'));
});
