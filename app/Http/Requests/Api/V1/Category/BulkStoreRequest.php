<?php

namespace App\Http\Requests\Api\V1\Category;

use App\Payloads\Api\V1\CategoryPayload;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class BulkStoreRequest extends FormRequest
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
            fn (array $category): CategoryPayload => CategoryPayload::make($category) 
        );
    }
}
