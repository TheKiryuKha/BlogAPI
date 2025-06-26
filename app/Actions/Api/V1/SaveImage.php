<?php

declare(strict_types=1);

namespace App\Actions\Api\V1;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final readonly class SaveImage
{
    public function handle(User $model, UploadedFile $image): bool
    {
        return DB::transaction(function () use ($model, $image): true {
            $model->getMedia()->each(
                fn (Media $media): mixed => $media->delete()
            );

            $model->addMedia($image)
                ->toMediaCollection();

            return true;
        });
    }
}
