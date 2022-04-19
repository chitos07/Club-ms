<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([

            RoleSeeder::class,
            UserSeeder::class,
            CurrencySeeder::class,
            BrancheSeeder::class,
            ResourceSeeder::class,
            CourseCategorySeeder::class,
            CancellationPolicySeeder::class,
            CourseTemplateSeeder::class,
            CourseElementSeeder::class,
            StaffSeeder::class,
            CourseSeeder::class,
            ClientSeeder::class,


        ]);

    }
}
