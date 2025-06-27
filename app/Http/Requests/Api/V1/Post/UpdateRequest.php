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
            'category_id' => ['required', 'int', 'exists:categories,id'],
            'title' => ['required', 'string', 'min:1', 'max:100'],
            'content' => ['required', 'string', 'min:1', 'max:255', 'unique:posts,content'],
            'status' => ['required', Rule::enum(PostStatus::class)],
            'image' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'tags' => ['sometimes', 'array'],
            'tags.*' => ['sometimes', 'int', 'exists:tags,id'],
        ];
    }

    public function payload(): PostPayload
    {
        /** @var Post $post */
        $post = $this->route('post');

        return PostPayload::make([
            'user_id' => $post->user_id,
            'category_id' => $this->integer('category_id'),
            'title' => $this->string('title')->toString(),
            'content' => $this->string('content')->toString(),
            'status' => $this->enum('status', PostStatus::class),
            'image' => $this->file('image'),
            'tags' => $this->array('tags'),
        ]);
    }
}
