<?php

declare(strict_types=1);

use App\Actions\Api\V1\EditPost;
use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\Tag;
use App\Payloads\Api\V1\PostPayload;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

it('edits post', function () {
    $post = Post::factory()->create();
    $tags = Tag::factory(3)->create();
    $payload = new PostPayload(
        $post->user_id,
        1,
        'title',
        'content',
        PostStatus::Draft,
        $tags->pluck('id')->toArray(),
        UploadedFile::fake()->image('test.png')
    );
    $action = app(EditPost::class);

    $action->handle($post, $payload);

    expect(Post::count())->toBe(1);

    expect(Post::first())
        ->title->toBe('title')
        ->user_id->toBe($post->user_id)
        ->category_id->toBe(1)
        ->content->toBe('content')
        ->status->toBe(PostStatus::Draft);

    expect(
        Post::first()->tags->pluck('id')
    )->toEqual(
        $tags->pluck('id')
    );

    expect(Post::first()->getFirstMedia())->toBeInstanceOf(Media::class);
});
