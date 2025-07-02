<?php

declare(strict_types=1);

use App\Actions\Api\V1\BulkCreateCategories;
use App\Models\Category;
use App\Payloads\Api\V1\CategoryPayload;

it('create categories', function () {
    $payloads = collect([
        1 => new CategoryPayload(title: 'test'),
        2 => new CategoryPayload(title: 'test'),
        3 => new CategoryPayload(title: 'test'),
    ]);
    $action = app(BulkCreateCategories::class);

    $action->handle($payloads);

    expect(Category::count())->toBe(3 + 1);

    Category::latest()->take(3)->get()->each(
        fn (Category $category) => expect($category->title)->toBe('test')
    );
});
