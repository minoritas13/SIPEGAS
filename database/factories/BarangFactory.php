<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'harga' => 20000,
            'stok_isi' => fake()->numberBetween(1, 200),
            'stok_kosong' => fake()->numberBetween(1,200),
            'stok_bocor' => fake()->numberBetween(1,10),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
