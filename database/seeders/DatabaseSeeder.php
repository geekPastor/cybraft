<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'chrinovic.mm@gmail.com',
            'password' => 'admin@2024',
            'role_id' => Role::ADMIN,
            'slug' => 'admin',
        ]);

        $this->call(RoleSeeder::class);
        $this->call(EntityTypeSeeder::class);
    }
}
