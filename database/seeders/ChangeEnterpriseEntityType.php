<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EntityType;

class ChangeEnterpriseEntityType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EntityType::where('name', 'entrepise')->update([
            'name' => 'entreprise',
        ]);
    }
}
