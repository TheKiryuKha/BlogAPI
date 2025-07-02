<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

test('user can register and get his token', function () {
    $original = Storage::getFacadeRoot();
    Storage::swap(new Illuminate\Filesystem\FilesystemManager(app()));

    $response = $this->post(route('api:auth:register'), [
        'name' => 'test',
        'email' => 'test@gmail.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])
        ->assertStatus(200);

    $token = $response->json('token');

    $this->assertTrue(
        PersonalAccessToken::findToken($token)->can('reader')
    );

    expect(User::first())
        ->name->toBe('test')
        ->email->toBe('test@gmail.com')
        ->role->toBe(UserRole::Reader);

    Storage::swap($original);
});
