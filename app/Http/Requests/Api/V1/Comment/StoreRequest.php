<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Comment;

use App\Payloads\Api\V1\CommentPayload;
use Illuminate\Foundation\Http\FormRequest;

final class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post_id' => ['required', 'int', 'exists:posts,id'],
            'text' => ['required', 'string', 'min:1', 'max:255'],
        ];
    }

    public function payload(): CommentPayload
    {
        /** @var \App\Models\User $user */
        $user = $this->user();

        return CommentPayload::make([
            'user_id' => $user->id,
            'post_id' => $this->integer('post_id'),
            'text' => $this->string('text')->toString(),
        ]);
    }
}
