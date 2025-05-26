<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        $province = \App\Models\Province::where('code', 'BA')->first();

        $citiesBA = [
            ['code' => 'LP',   'name' => 'La Plata'],
            ['code' => 'MDP',  'name' => 'Mar del Plata'],
            ['code' => 'BAH',  'name' => 'Bahía Blanca'],
            ['code' => 'ZAR',  'name' => 'Zárate'],
            ['code' => 'PER',  'name' => 'Pergamino'],
            ['code' => 'TAN',  'name' => 'Tandil'],
            ['code' => 'MER',  'name' => 'Mercedes'],
            ['code' => 'OLV',  'name' => 'Olavarría'],
            ['code' => 'SAN',  'name' => 'San Nicolás'],
            ['code' => 'LNH',  'name' => 'Lomas de Zamora'],
            ['code' => 'MOR',  'name' => 'Morón'],
            ['code' => 'AV',   'name' => 'Avellaneda'],
            ['code' => 'QUN',  'name' => 'Quilmes'],
            ['code' => 'VIC',  'name' => 'Vicente López'],
            ['code' => 'SANM', 'name' => 'San Martín'],
            ['code' => 'TIG',  'name' => 'Tigre'],
        ];

        foreach ($citiesBA as $city) {
            \App\Models\City::firstOrCreate(
                [
                    'code' => $city['code'],
                    'province_id' => $province->id
                ],
                [
                    'uuid' => \Illuminate\Support\Str::uuid(),
                    'name' => $city['name'],
                ]
            );
        }

        $caba = \App\Models\Province::where('code', 'CABA')->first();

        \App\Models\City::firstOrCreate(
            [
                'code' => 'CABA',
                'province_id' => $caba->id,
            ],
            [
                'uuid' => \Illuminate\Support\Str::uuid(),
                'name' => 'Ciudad Autónoma de Buenos Aires',
            ]
        );
    }
}
