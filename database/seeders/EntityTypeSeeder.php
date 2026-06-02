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
        foreach ([
            1 => 'établissement',
            2 => 'entreprise',
            3 => 'université',
            4 => 'école',
        ] as $id => $name) {
            EntityType::updateOrCreate(['id' => $id], ['name' => $name]);
        }
    }
}
