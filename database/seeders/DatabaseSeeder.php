<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Seeders\CategorySeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\PostTagSeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {  
        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
            UserSeeder::class,
            CommentSeeder::class,
            PostTagSeeder::class,
            ImageSeeder::class
        ]);
    }
}
