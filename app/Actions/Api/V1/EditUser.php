<?php

declare(strict_types=1);

namespace App\Actions\Api\V1;

use App\Models\User;
use App\Payloads\Api\V1\UserPayload;
use Illuminate\Support\Facades\DB;

final readonly class EditUser
{
    public function __construct(
        private SaveImage $action
    ) {}

    public function handle(User $user, UserPayload $payload): User
    {
        return DB::transaction(function () use ($user, $payload): User {

            match ($payload->getAvatar()) {
                null => null,
                default => $this->action->handle(
                    model: $user, image: $payload->getAvatar()
                )
            };

            $user->update($payload->toArray());

            return $user;
        });
    }
}
