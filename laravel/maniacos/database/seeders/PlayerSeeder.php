<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Player;
use Carbon\Carbon;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Player::factory()
            ->count(20)
            ->withPositions()
            ->create();
    }
}
