<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use Illuminate\Http\Response;

final class ShowController
{
    public function __invoke(): Response
    {
        return response(status: 200);
    }
}
