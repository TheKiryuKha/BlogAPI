<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Tag;

use App\Payloads\Api\V1\TagPayload;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

final class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('is-admin-or-author');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:1', 'max:255'],
        ];
    }

    public function payload(): TagPayload
    {
        return TagPayload::make([
            'title' => $this->string('title')->toString(),
        ]);
    }
}
