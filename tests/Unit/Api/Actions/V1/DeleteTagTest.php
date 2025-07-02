<?php

declare(strict_types=1);

use App\Actions\Api\V1\DeleteTag;
use App\Models\Post;
use App\Models\Tag;

it('deletes tag', function () {
    $tag = Tag::factory()
        ->has(Post::factory(3))
        ->create();
    $action = app(DeleteTag::class);

    $action->handle($tag);

    expect(Tag::count())->toBe(0);
});
