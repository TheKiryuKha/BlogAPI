<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Post;

use App\Enums\PostStatus;
use App\Models\User;
use App\Payloads\Api\V1\PostPayload;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

final class StoreRequest extends FormRequest
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
            'category_id' => ['sometimes', 'int', 'exists:categories,id'],
            'title' => ['required', 'string', 'min:1', 'max:100'],
            'content' => ['required', 'string', 'min:1', 'max:255', 'unique:posts,content'],
            'status' => ['sometimes', Rule::enum(PostStatus::class)],
            'image' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function payload(): PostPayload
    {
        /** @var User $user */
        $user = $this->user();

        return PostPayload::make([
            'user_id' => $user->id,
            'category_id' => $this->integer('category_id') ?? 1,
            'title' => $this->string('title')->toString(),
            'content' => $this->string('content')->toString(),
            'status' => $this->enum('status', PostStatus::class) ?? PostStatus::Draft,
            'image' => $this->file('image'),
        ]);
    }
}
