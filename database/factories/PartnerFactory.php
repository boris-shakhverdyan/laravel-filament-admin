<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Partner>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'website' => $this->faker->url,
            'logo' => $this->faker->imageUrl(200, 200, 'business', true, 'logo'),
            'location' => [
                'lat' => $this->faker->latitude(),
                'lng' => $this->faker->longitude(),
            ],
        ];
    }
}
