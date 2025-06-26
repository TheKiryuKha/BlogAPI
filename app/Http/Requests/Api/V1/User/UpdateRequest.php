<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\User;

use App\Enums\UserRole;
use App\Models\User;
use App\Payloads\Api\V1\UserPayload;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'min:1', 'max:25'],
            'role' => ['sometimes', Rule::enum(UserRole::class)],
            'description' => ['sometimes', 'string', 'min:1', 'max:100'],
            'avatar' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function payload(): UserPayload
    {
        /** @var User $user */
        $user = $this->user();

        return UserPayload::make([
            'name' => $this->string('name')->toString() ?? $user->name,
            'role' => $this->enum('role', UserRole::class) ?? $user->role,
            'description' => $this->string('description')->toString() ?? $user->description,
            'avatar' => $this->file('avatar'),
        ]);
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator): void {
            if ($this->has('role') && $this->user()->tokenCant('admin')) {
                $validator->errors()->add(
                    'role',
                    'You do not have permission to change this field'
                );
            }
        });
    }
}
