<?php

declare(strict_types=1);

use App\Actions\Api\V1\DeleteUser;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

it('deletes user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    Comment::factory(3)->create([
        'user_id' => $user->id,
        'post_id' => $post->id,
    ]);
    $action = app(DeleteUser::class);

    $action->handle($user);

    $this->assertTrue($user->posts->isEmpty());

    $this->assertTrue($user->comments->isEmpty());

    expect(User::count())->toBe(0);
});
