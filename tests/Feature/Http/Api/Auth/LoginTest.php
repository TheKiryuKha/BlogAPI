<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

test('user(reader) can login and get his token', function () {
    $user = User::factory()->create();

    $response = $this->post(route('api:auth:login'), [
        'email' => $user->email,
        'password' => 'password',
    ])
        ->assertStatus(200);

    $token = $response->json('token');

    $this->assertTrue(
        PersonalAccessToken::findToken($token)->can('reader')
    );
});

test('user(author) can login and get his token', function () {
    $user = User::factory()->create(['role' => UserRole::Author]);

    $response = $this->post(route('api:auth:login'), [
        'email' => $user->email,
        'password' => 'password',
    ])
        ->assertStatus(200);

    $token = $response->json('token');

    $this->assertTrue(
        PersonalAccessToken::findToken($token)->can('author')
    );
});

test('user(admin) can login and get his token', function () {
    $user = User::factory()->create(['role' => UserRole::Admin]);

    $response = $this->post(route('api:auth:login'), [
        'email' => $user->email,
        'password' => 'password',
    ])
        ->assertStatus(200);

    $token = $response->json('token');

    $this->assertTrue(
        PersonalAccessToken::findToken($token)->can('admin')
    );
});

test('expection Bad Request while authenctication with wrong credentials', function () {
    $this->post(route('api:auth:login'), [
        'email' => 'email@gmail.com',
        'password' => 'password',
    ])
        ->assertStatus(500);
});

test('302 status code with invalide data', function () {
    $this->post(route('api:auth:login'))
        ->assertStatus(302);
});
