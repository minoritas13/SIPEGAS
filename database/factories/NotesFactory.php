<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Notes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notes>
 */
class NotesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Notes::class;
    
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'notes' => fake()->unique()->text(),
        ];
    }
}
