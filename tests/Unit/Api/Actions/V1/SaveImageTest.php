<?php

declare(strict_types=1);

use App\Actions\Api\V1\SaveImage;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;

it('save image for User', function () {
    $user = User::factory()->create();
    $avatar = UploadedFile::fake()->image('test.png');
    $action = app(SaveImage::class);

    $action->handle($user, $avatar);

    $user->refresh();

    expect($user->getFirstMedia('default'))
        ->not->toBeNull()
        ->and($user->getFirstMedia('default')->file_name)
        ->toBe('test.png');
});

it('save image for Post', function () {
    $post = Post::factory()->create();
    $avatar = UploadedFile::fake()->image('test.png');
    $action = app(SaveImage::class);

    $action->handle($post, $avatar);

    $post->refresh();

    expect($post->getFirstMedia('default'))
        ->not->toBeNull()
        ->and($post->getFirstMedia('default')->file_name)
        ->toBe('test.png');
});
