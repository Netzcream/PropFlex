<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RoleAndPermissionSeeder::class,
            PropertyFeatureSeeder::class,
            PropertyTypeSeeder::class,
            PropertyOperationTypeSeeder::class,
            PropertyStatusSeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
            NeighborhoodSeeder::class,
            PropertySeeder::class
        ]);
        Contact::factory()->count(15)->create();
    }
}
