<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Category;

use App\Payloads\Api\V1\CategoryPayload;
use Illuminate\Foundation\Http\FormRequest;

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
            'title' => [
                'required',
                'string',
                'min:1',
                'max:255',
                'unique:categories,title',
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
