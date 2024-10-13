<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand_id'     => $this->faker->numberBetween(1, 100),
            'vendor_code'  => $this->faker->name(),
            'release'      => $this->faker->year(),
            'engine'       => $this->faker->randomElement(['petrol', 'diesel', 'hybrid', 'electric']),
            'transmission' => $this->faker->randomElement([null, true, false,]),
            'price'        => $this->faker->randomFloat(2, 0.01, 9999.99),
            'alias'        => $this->faker->unique()->slug(),
            'description'  => $this->faker->text(150),
            'active'       => $this->faker->randomKey([true, false]),
            'views'        => $this->faker->randomNumber()
        ];
    }
}
