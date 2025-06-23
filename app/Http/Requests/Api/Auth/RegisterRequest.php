<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Auth;

use App\Enums\UserRole;
use App\Payloads\Api\Auth\RegisterPayload;
use Illuminate\Foundation\Http\FormRequest;

final class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],
            'password' => ['required', 'confirmed', 'min:8'],
        ];
    }

    public function payload(): RegisterPayload
    {
        return RegisterPayload::make([
            'name' => $this->string('name')->toString(),
            'email' => $this->string('email')->toString(),
            'password' => $this->string('password')->toString(),
            'role' => UserRole::Reader,
        ]);
    }
}
