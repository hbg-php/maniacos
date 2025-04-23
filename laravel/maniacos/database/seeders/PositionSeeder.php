<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            ['name' => 'Armador', 'code' => 1],
            ['name' => 'Ala-Armador', 'code' => 2],
            ['name' => 'Ala', 'code' => 3],
            ['name' => 'Ala-Pivô', 'code' => 4],
            ['name' => 'Pivô', 'code' => 5],
        ];

        foreach ($positions as $position) {
            Position::create($position);
        }
    }
}
