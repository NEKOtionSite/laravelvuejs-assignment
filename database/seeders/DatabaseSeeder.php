<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * The DatabaseSeeder seeder class.
 *
 * This seeder class is the main seeder responsible for seeding the application's database.
 * It calls other specific seeder classes, such as BookSeeder, to seed different tables in the database.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Call other specific seeder classes here to seed different tables in the database.
        $this->call([
            BookSeeder::class
            // Add other seeder classes here if needed.
        ]);
    }
}
