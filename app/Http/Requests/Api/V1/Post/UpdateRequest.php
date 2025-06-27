<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Post;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Payloads\Api\V1\PostPayload;
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
            'category_id' => ['sometimes', 'int', 'exists:categories,id'],
            'title' => ['sometimes', 'string', 'min:1', 'max:100'],
            'content' => ['sometimes', 'string', 'min:1', 'max:255', 'unique:posts,content'],
            'status' => ['sometimes', Rule::enum(PostStatus::class)],
            'image' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function payload(): PostPayload
    {
        /** @var Post $post */
        $post = $this->route('post');

        return PostPayload::make([
            'user_id' => $post->user_id,
            'category_id' => $this->integer('category_id') ?? $post->category_id,

            'title' => $this->filled('title')
                                    ? $this->string('title')->toString()
                                    : $post->title,

            'content' => $this->filled('content')
                                    ? $this->string('content')->toString()
                                    : $post->content,

            'status' => $this->enum('status', PostStatus::class) ?? $post->status,
            'image' => $this->file('image'),
        ]);
    }
}
