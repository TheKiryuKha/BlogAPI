<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Comment;

use App\Models\Comment;
use App\Payloads\Api\V1\CommentPayload;
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
            'text' => ['required', 'string', 'min:1', 'max:255'],
        ];
    }

    public function payload(): CommentPayload
    {
        /** @var Comment $comment */
        $comment = $this->route('comment');

        return CommentPayload::make([
            'text' => $this->string('text')->toString(),
            'user_id' => $comment->user_id,
            'post_id' => $comment->post_id,
        ]);
    }
}
