<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RoleSeeder::class);
        $this->call(EntityTypeSeeder::class);

        User::updateOrCreate([
            'email' => 'admin@mycybcraft.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('cybcraftAdmin-2024'),
            'mdp' => 'cybcraftAdmin-2024',
            'role_id' => Role::ADMIN,
            'slug' => 'admin',
        ]);
    }
}
