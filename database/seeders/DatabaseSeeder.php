<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->author()
            ->has(Post::factory()->count(50))
            ->count(5)
            ->create();

        User::factory()
            ->admin()
            ->count(1)
            ->create();
    }
}
