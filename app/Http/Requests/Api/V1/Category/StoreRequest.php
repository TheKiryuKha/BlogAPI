<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Category;

use App\Enums\UserRole;
use App\Models\User;
use App\Payloads\Api\V1\CategoryPayload;
use Illuminate\Foundation\Http\FormRequest;

final class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        if ($user->tokenCan('author') && $user->role === UserRole::Author) {
            return true;
        }

        return $user->tokenCan('admin') && $user->role === UserRole::Admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:1',
                'max:255',
            ],
        ];
    }

    public function payload(): CategoryPayload
    {
        return CategoryPayload::make([
            'title' => $this->string('title')->toString(),
        ]);
    }
}
