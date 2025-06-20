<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Auth;

use App\Payloads\Api\Auth\LoginPayload;
use Illuminate\Foundation\Http\FormRequest;

final class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ];
    }

    public function payload(): LoginPayload
    {
        return LoginPayload::make([
            'email' => $this->string('email')->toString(),
            'password' => $this->string('password')->toString(),
        ]);
    }
}
