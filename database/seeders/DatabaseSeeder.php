<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\{Brand, Car, CarPhoto, User};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

//        $this->call(BrandsTableSeeder::class);
//        $this->call(CarsTableSeeder::class);
//        $this->call(CarPhotosTableSeeder::class);

        Brand::factory(100)->create();
        Car::factory(100)->create();
        CarPhoto::factory(100)->create();
    }
}
