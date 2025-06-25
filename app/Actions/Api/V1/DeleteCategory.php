<?php

declare(strict_types=1);

namespace App\Actions\Api\V1;

use App\Models\Category;
use DB;
use Illuminate\Database\Eloquent\Collection;

final readonly class DeleteCategory
{
    public function handle(Category $category): Collection
    {
        return DB::transaction(function() use ($category){
            foreach($category->posts as $post){
                $post->update([
                    'category_id' => 1
                ]);
            }

            $category->delete();

            return $category->posts->load('category');
        });
    }
}