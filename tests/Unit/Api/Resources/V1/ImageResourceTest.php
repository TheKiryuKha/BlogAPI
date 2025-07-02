<?php

declare(strict_types=1);

use App\Http\Resources\Api\V1\ImageResource;
use App\Models\Post;
use Illuminate\Http\UploadedFile;

it('returns right data', function () {
    $post = Post::factory()->create();

    $post->addMedia(
        UploadedFile::fake()->image('test.png')
    )->toMediaCollection();

    $resource = new ImageResource($post->getMedia()->first());

    $data = $resource->toArray(request());

    $this->assertArrayHasKey('original_url', $data);
    $this->assertArrayHasKey('preview_url', $data);
});
