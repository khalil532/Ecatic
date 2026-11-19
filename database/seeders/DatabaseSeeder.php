<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SiteSettingsSeeder::class,
            ActivitiesSeeder::class,
            ServicesSeeder::class,
            ProjectsDemoSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}
