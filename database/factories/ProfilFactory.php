<?php

namespace Database\Factories;

use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profil>
 */
class ProfilFactory extends Factory
{
    protected $model = Profil::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'image' => $this->faker->image('public/storage/images/profils', 640, 480, null, false),
            'status' => $this->faker->randomElement(['inactive', 'pending', 'active']),
        ];
    }
}
