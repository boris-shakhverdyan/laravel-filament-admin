<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\ActivityType;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'short_description' => $this->faker->text(150),
            'registration_url' => $this->faker->optional()->url(),
            'location' => [
                'lat' => $this->faker->latitude(),
                'lng' => $this->faker->longitude(),
            ],
            'partner_id' => Partner::inRandomOrder()->first()?->id,
            'created_by' => User::role(['admin', 'editor'])->inRandomOrder()->first()?->id,
            'activity_type_id' => ActivityType::inRandomOrder()->first()?->id,
        ];
    }
}
