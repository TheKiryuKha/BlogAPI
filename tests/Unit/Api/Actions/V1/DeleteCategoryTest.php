<?php

declare(strict_types=1);

use App\Actions\Api\V1\DeleteCategory;
use App\Models\Category;
use App\Models\Post;

it('deletes category', function () {
    $category = Category::factory()
        ->has(Post::factory()->count(3))
        ->create();
    $action = app(DeleteCategory::class);

    $action->handle($category);

    $category->posts->each(
        fn (Post $post) => expect($post->category_id)->toBe(1)
    );

    expect(Category::count())->toBe(0 + 1);
});
