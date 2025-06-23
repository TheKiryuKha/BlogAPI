<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Payloads\Api\Auth\RegisterPayload;

it('makes new payload and returns its data in array', function () {
    $data = [
        'name' => 'test',
        'email' => 'test@gmail.com',
        'role' => UserRole::Reader,
        'password' => 'password',
    ];

    $payload = RegisterPayload::make($data);

    expect($payload)->toBeInstanceOf(RegisterPayload::class);
    expect($payload->toArray())->toEqual($data);
});
