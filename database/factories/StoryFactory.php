<?php

namespace Database\Factories;

use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoryFactory extends Factory
{
    protected $model = Story::class;

    public function definition()
    {
        $createdAt = Carbon::now()->subDays(rand(0, 30)); // Date de création aléatoire
        $expiresAt = $createdAt->copy()->addHours(24); // Expire 24 heures après la création

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'image_url' => function () {
                $randomName = Str::uuid();
                $imageUrl = "https://picsum.photos/1080/1920.webp?random={$randomName}";
                $path = "stories/{$randomName}.webp";
                Storage::disk('public')->put($path, file_get_contents($imageUrl));

                return $path;
            },
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
            'expires_at' => $expiresAt, // Ajoute la date d'expiration
        ];
    }
}
