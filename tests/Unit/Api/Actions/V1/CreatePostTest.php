<?php

declare(strict_types=1);

use App\Actions\Api\V1\CreatePost;
use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Payloads\Api\V1\PostPayload;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

it('creates post', function () {
    $tags = Tag::factory()->create();
    $user = User::factory()->create();
    $payload = new PostPayload(
        $user->id,
        1,
        'title',
        'content',
        PostStatus::Draft,
        $tags->pluck('id')->toArray()
    );
    $action = app(CreatePost::class);

    $action->handle($payload);

    expect(Post::count())->toBe(1);

    expect(Post::first())
        ->title->toBe('title')
        ->user_id->toBe($user->id)
        ->category_id->toBe(1)
        ->content->toBe('content')
        ->status->toBe(PostStatus::Draft);

    expect(Post::first()->tags->pluck('id'))->toEqual($tags->pluck('id'));
});

it('creates post with an image', function () {
    $tags = Tag::factory()->create();
    $user = User::factory()->create();
    $payload = new PostPayload(
        $user->id,
        1,
        'title',
        'content',
        PostStatus::Draft,
        $tags->pluck('id')->toArray(),
        UploadedFile::fake()->image('test.png')
    );
    $action = app(CreatePost::class);

    $action->handle($payload);

    expect(Post::count())->toBe(1);

    expect(Post::first())
        ->title->toBe('title')
        ->user_id->toBe($user->id)
        ->category_id->toBe(1)
        ->content->toBe('content')
        ->status->toBe(PostStatus::Draft);

    expect(
        Post::first()->tags->pluck('id')
    )->toEqual(
        $tags->pluck('id')
    );

    expect(Post::first()->getMedia()->first())->toBeInstanceOf(Media::class);
});
