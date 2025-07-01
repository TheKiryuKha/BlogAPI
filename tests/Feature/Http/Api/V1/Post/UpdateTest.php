<?php

declare(strict_types=1);

use App\Enums\PostStatus;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

test('user can update his post', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $post = Post::factory()->create([
        'user_id' => $user->id,
    ]);
    $new_post = [
        'title' => 'Test',
        'category_id' => $category->id,
        'status' => 'published',
        'content' => 'Test',
    ];

    $this->actingAs($user)
        ->put(route('api:v1:posts:update', $post), $new_post)
        ->assertStatus(200);

    expect(Post::first())
        ->title->toBe($new_post['title'])
        ->category_id->toBe($new_post['category_id'])
        ->status->toBe(PostStatus::Published)
        ->content->toBe($new_post['content']);
});

test('user can update his post with image', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $post = Post::factory()->create([
        'user_id' => $user->id,
    ]);
    $new_post = [
        'title' => 'Test',
        'category_id' => $category->id,
        'status' => 'published',
        'content' => 'Test',
        'image' => UploadedFile::fake()->image('test.png'),
    ];

    $this->actingAs($user)
        ->put(route('api:v1:posts:update', $post), $new_post)
        ->assertStatus(200);

    expect(Post::first())
        ->title->toBe($new_post['title'])
        ->category_id->toBe($new_post['category_id'])
        ->status->toBe(PostStatus::Published)
        ->content->toBe($new_post['content'])
        ->getMedia()->first()->toBeInstanceOf(Media::class);
});

test('Nobody can update not his post', function () {
    $post = Post::factory()->create();
    $new_post = [
        'title' => 'Test',
        'category_id' => $post->category_id,
        'status' => 'published',
        'content' => 'Test',
    ];

    $user = User::factory()->create();

    $this->actingAs($user)
        ->put(route('api:v1:posts:update', $post), $new_post)
        ->assertStatus(403);

    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->put(route('api:v1:posts:update', $post), $new_post)
        ->assertStatus(403);

    $author = User::factory()->author()->create();

    $this->actingAs($author)
        ->put(route('api:v1:posts:update', $post), $new_post)
        ->assertStatus(403);
});
