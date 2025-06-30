<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Tag;

use App\Payloads\Api\V1\TagPayload;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

final class BulkStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.title' => [
                'required',
                'string',
                'min:1',
                'max:255',
            ],
        ];
    }

    public function payload(): Collection
    {
        return collect($this->validated())->map(
            fn (array $category): TagPayload => TagPayload::make($category)
        );
    }
}
