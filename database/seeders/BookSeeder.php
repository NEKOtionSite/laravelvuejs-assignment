<?php

namespace Database\Seeders;

use Database\Factories\BookFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * The BookSeeder seeder class.
 *
 * This seeder class is responsible for seeding the 'books' table with dummy book records.
 * It uses the BookFactory to generate fake book data and insert it into the database.
 */
class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a new instance of the BookFactory to generate fake book data.
        $fact = new BookFactory();

        // Use the count() method to specify the number of fake book records to create (in this case, 5).
        // The create() method inserts the generated records into the 'books' table.
        $fact->count(5)
            ->create()
            ;
    }
}
