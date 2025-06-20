<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Models\User;
use App\Payloads\Api\Auth\LoginPayload;
use App\Services\Api\Auth\IdentityService;

it('logins user(reader) and creates token for him', function () {
    $user = User::factory()->create();
    $service = app(IdentityService::class);
    $payload = LoginPayload::make([
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertTrue($service->login($payload));

    $token = $service->createToken('test');

    $this->assertTrue($token->accessToken->can('reader'));
});

it('logins user(author) and creates token for him', function () {
    $user = User::factory()->create(['role' => UserRole::Author]);
    $service = app(IdentityService::class);
    $payload = LoginPayload::make([
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertTrue($service->login($payload));

    $token = $service->createToken('test');

    $this->assertTrue($token->accessToken->can('author'));
});

it('logins user(admin) and creates token for him', function () {
    $user = User::factory()->create(['role' => UserRole::Admin]);
    $service = app(IdentityService::class);
    $payload = LoginPayload::make([
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertTrue($service->login($payload));

    $token = $service->createToken('test');

    $this->assertTrue($token->accessToken->can('admin'));
});
