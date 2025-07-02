<?php

declare(strict_types=1);

use App\Actions\Api\V1\DeletePost;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\UploadedFile;

it('deletes post', function () {
    $post = Post::factory()
        ->has(Comment::factory()->count(3))
        ->create();
    $tags = Tag::factory()->count(3)->create();
    $post->tags()->sync($tags);
    $post->addMedia(
        UploadedFile::fake()->image('test.png')
    );

    $action = app(DeletePost::class);

    $action->handle($post);

    $this->assertTrue($post->getMedia()->isEmpty());

    $this->assertTrue($post->comments->isEmpty());

    expect(Post::count())->toBe(0);
});
