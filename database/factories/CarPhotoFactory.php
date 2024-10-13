<?php

namespace Database\Factories;

use File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarPhoto>
 */
class CarPhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $car_id = $this->faker->unique()->numberBetween(1, 100);

        return [
            'car_id' => $car_id,
            'image' => $this->faker->image($this->getImagePath($car_id), 640, 480, null, false),
            'sort' => $this->faker->numberBetween(1, 10)
        ];
    }

    /**
     * @param int $car_id
     * @return string
     */
    private function getImagePath(int $car_id): string
    {
        $filepath = storage_path('app/public/images/cars/' . $car_id);

        File::makeDirectory($filepath, 0755, true, true);

        return $filepath;
    }
}
