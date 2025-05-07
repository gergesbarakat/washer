<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Courier;

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
            'name' => 'Test User',
            'email' => 'user@gmail.com',
        ]);
        Admin::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@gmail.com',
        ]);
        Courier::factory()->create([
            'name' => 'Test User',
            'email' => 'courier@gmail.com',
        ]);
    }
}
