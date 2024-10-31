<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;

class StorySeeder extends Seeder
{
    public function run()
    {
        // Crée 50 stories aléatoires
        Story::factory()->count(100)->create();
    }
}
