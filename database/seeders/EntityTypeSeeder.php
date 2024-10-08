<?php

namespace Database\Seeders;

use App\Models\EntityType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EntityType::factory(4)->sequence(
            [
                'name' => 'établissement',
            ],
            [
                'name' => 'entrepise',
            ],
            [
                'name' => 'université',
            ],
            [
                'name' => 'école',
            ]
        )->create();
    }
}
