<?php

namespace Database\Seeders;

use App\Models\Product;
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
            'email' => 'user@example.com',
        ]);

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'is_admin' => true
        ]);

        Product::factory()->create([
            'name' => 'Aqua',
            'price' => '5000',
            'description' => 'Ini air saja',
            'image' => ''
        ]);

        Product::factory()->create([
            'name' => 'Vit',
            'price' => '5000',
            'description' => 'Ini air saja',
            'image' => ''
        ]);

        Product::factory()->create([
            'name' => 'Le Minerale',
            'price' => '5000',
            'description' => 'Ini air saja',
            'image' => ''
        ]);

    }
}
