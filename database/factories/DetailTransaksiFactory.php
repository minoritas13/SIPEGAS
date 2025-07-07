<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Barang;
use App\Models\DetailTransaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailTransaksi>
 */
class DetailTransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = DetailTransaksi::class;

    public function definition(): array
    {
        
        $user = User::inRandomOrder()->first();
        $barang = Barang::inRandomOrder()->first();

        return [
            'user_id'   => $user?->id ?? 1,
            'barang_id' => $barang?->id ?? 1,
            'pembeli' => fake()->name(),
            'jumlah' => fake()->numberBetween(1, 30),
            'total' => fake()->numberBetween(19000, 20000),
        ];
    }
}
