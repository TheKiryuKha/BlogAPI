<?php

declare(strict_types=1);

use App\Actions\Api\V1\EditUser;
use App\Enums\UserRole;
use App\Models\User;
use App\Payloads\Api\V1\UserPayload;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

it('edits user', function () {
    $user = User::factory()->create();
    $payload = new UserPayload(
        name: 'Test',
        description: 'Content',
        role: $user->role,
        avatar: UploadedFile::fake()->image('test.png')
    );
    $action = app(EditUser::class);

    $action->handle($user, $payload);

    expect(User::count())->toBe(1);

    expect(User::first())
        ->name->toBe('Test')
        ->description->toBe('Content')
        ->role->toBe(UserRole::Reader)
        ->getFirstMedia()->toBeInstanceOf(Media::class);
});
