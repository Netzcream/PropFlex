<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PropertyStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            ['code' => 'DISP', 'name' => 'Disponible'],
            ['code' => 'RES',  'name' => 'Reservada'],
            ['code' => 'VEND', 'name' => 'Vendida'],
            ['code' => 'ALQ',  'name' => 'Alquilada'],
        ];

        foreach ($statuses as $status) {
            \App\Models\PropertyStatus::firstOrCreate(
                ['code' => $status['code']],
                [
                    'uuid' => \Illuminate\Support\Str::uuid(),
                    'name' => $status['name'],
                ]
            );
        }
    }
}
