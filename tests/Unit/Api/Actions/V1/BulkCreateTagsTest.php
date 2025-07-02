<?php

declare(strict_types=1);

use App\Actions\Api\V1\BulkCreateTags;
use App\Models\Tag;
use App\Payloads\Api\V1\TagPayload;

it('creates tags', function () {
    $payloads = collect([
        1 => new TagPayload(title: 'test'),
        2 => new TagPayload(title: 'test'),
        3 => new TagPayload(title: 'test'),
    ]);
    $action = app(BulkCreateTags::class);

    $action->handle($payloads);

    $tags = Tag::all();

    expect($tags)->toHaveCount(3);

    $tags->each(
        fn (Tag $tag) => expect($tag->title)->toBe('test')
    );
});
