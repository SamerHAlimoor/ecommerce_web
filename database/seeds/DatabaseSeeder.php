<?php

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
         $this->call(SettingDatabaseSeeder::class);
        $this->call(MainAdminSeeder::class);
        $this->call(CategoryDBSeeder::class);
        $this->call(SubCategoryDBSeeder::class);

    }
}
