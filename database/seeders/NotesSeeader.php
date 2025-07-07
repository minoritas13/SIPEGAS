<?php

namespace Database\Seeders;

use App\Models\Notes;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NotesSeeader extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notes::factory(10)->create();
    }
}
