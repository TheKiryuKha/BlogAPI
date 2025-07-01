<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\User;

use App\Enums\UserRole;
use App\Payloads\Api\V1\UserPayload;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

final class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'PATCH' => [
                'role' => ['required', Rule::enum(UserRole::class)],
            ],
            default => [
                'name' => ['required', 'string', 'min:1', 'max:25'],
                'description' => ['required', 'string', 'min:1', 'max:100'],
                'avatar' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ]
        };
    }

    public function payload(): UserPayload
    {
        /** @var User $user */
        $user = $this->route('user');

        return UserPayload::make([
            'name' => $this->string('name')->toString(),

            'description' => $this->string('description')->toString(),

            'avatar' => $this->file('avatar'),
            'role' => $user->role
        ]);
    }
}
