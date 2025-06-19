<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->author()
            ->count(5)
            ->has(
                Post::factory([
                    'category_id' => fn() => Category::inRandomOrder()->first()->id
                ])
                ->count(50)
            )
            ->create();
        
        User::factory()
            ->admin()
            ->has(
                Post::factory([
                    'category_id' => fn() => Category::inRandomOrder()->first()->id
                ])
                ->count(10)
            )
            ->create();

        User::factory()
            ->count(20)
            ->create();
    }
}
