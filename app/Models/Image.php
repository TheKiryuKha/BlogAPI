<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property-read int $id
 * @property-read string $path
 * @property-read int $owner_id
 * @property-read string $owner_type
 * @property-read CarbonImmutable $created_at
 * @property-read CarbonImmutable $updated_at
 * @property-read User|Post $owner
 */
final class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory;

    /**
     * @return MorphTo<Model, $this>
     */
    public function owner(): MorphTo
    {
        return $this->morphTo();
    }
}
