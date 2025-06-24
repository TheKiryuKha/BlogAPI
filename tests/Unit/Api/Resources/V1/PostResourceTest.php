<?php

declare(strict_types=1);

use App\Http\Resources\Api\V1\DateResource;
use App\Http\Resources\Api\V1\PostResource;
use App\Models\Post;

it('returns right data', function () {
    $post = Post::factory()->create();
    $resource = new PostResource($post);

    $data = $resource->toArray(request());

    $this->assertArrayHasKey('id', $data);
    $this->assertArrayHasKey('type', $data);
    $this->assertArrayHasKey('attributes', $data);
    $this->assertArrayHasKey('relationships', $data);
    $this->assertArrayHasKey('links', $data);

    $this->assertEquals($post->id, $data['id']);
    $this->assertEquals('post', $data['type']);
    $this->assertEquals(
        [
            'title' => $post->title,
            'slug' => $post->slug,
            'content' => $post->content,
            'status' => $post->status,
            'created' => new DateResource(
                $post->created_at
            ),
        ],
        $data['attributes']
    );
});
