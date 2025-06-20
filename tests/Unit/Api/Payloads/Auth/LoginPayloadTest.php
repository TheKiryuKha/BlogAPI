<?php

declare(strict_types=1);

use App\Payloads\Api\Auth\LoginPayload;

it('makes new payload and returns its data in array', function () {
    $data = [
        'email' => 'test@gmail.com',
        'password' => 'test',
    ];

    $payload = LoginPayload::make($data);

    expect($payload->toArray())->toBe($data);
});
