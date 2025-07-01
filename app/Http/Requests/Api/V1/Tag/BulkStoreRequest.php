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

    /**
     * @return Collection<int, TagPayload>
     */
    public function payload(): Collection
    {
        /** @var array<array-key, array{title: string}> $validated */
        $validated = $this->validated();

        return collect(array_values($validated))->map(
            /** @var array{title: string} $tag */
            fn (array $tag, int $key): TagPayload => TagPayload::make($tag)
        );
    }
}
