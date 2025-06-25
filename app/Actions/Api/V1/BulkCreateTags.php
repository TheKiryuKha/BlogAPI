<?php

declare(strict_types=1);

namespace App\Actions\Api\V1;

use App\Models\Tag;
use App\Payloads\Api\V1\TagPayload;
use DB;
use Illuminate\Support\Collection;

final readonly class BulkCreateTags
{
    /**
     * @param  Collection<int, TagPayload>  $payloads
     * @return Collection<int, Tag>
     */
    public function handle(Collection $payloads): Collection
    {
        return DB::transaction(fn () => $payloads->map(
            fn (TagPayload $paylod): Tag => Tag::create(
                $paylod->toArray()
            )
        ));
    }
}
