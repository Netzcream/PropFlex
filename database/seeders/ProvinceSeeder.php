<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    public function run()
    {
        $provinces = [
            ['code' => 'BA',   'name' => 'Buenos Aires'],
            ['code' => 'CABA', 'name' => 'Ciudad Autónoma de Buenos Aires'],
            ['code' => 'CAT',  'name' => 'Catamarca'],
            ['code' => 'CHA',  'name' => 'Chaco'],
            ['code' => 'CHU',  'name' => 'Chubut'],
            ['code' => 'COR',  'name' => 'Córdoba'],
            ['code' => 'ERI',  'name' => 'Entre Ríos'],
            ['code' => 'FOR',  'name' => 'Formosa'],
            ['code' => 'JUJ',  'name' => 'Jujuy'],
            ['code' => 'LAP',  'name' => 'La Pampa'],
            ['code' => 'LAR',  'name' => 'La Rioja'],
            ['code' => 'MEN',  'name' => 'Mendoza'],
            ['code' => 'MIS',  'name' => 'Misiones'],
            ['code' => 'NEU',  'name' => 'Neuquén'],
            ['code' => 'RNO',  'name' => 'Río Negro'],
            ['code' => 'SAL',  'name' => 'Salta'],
            ['code' => 'SJU',  'name' => 'San Juan'],
            ['code' => 'SLU',  'name' => 'San Luis'],
            ['code' => 'SCR',  'name' => 'Santa Cruz'],
            ['code' => 'SFE',  'name' => 'Santa Fe'],
            ['code' => 'SGO',  'name' => 'Santiago del Estero'],
            ['code' => 'TDF',  'name' => 'Tierra del Fuego, Antártida e Islas del Atlántico Sur'],
            ['code' => 'TUC',  'name' => 'Tucumán'],
        ];

        foreach ($provinces as $province) {
            \App\Models\Province::firstOrCreate(
                ['code' => $province['code']],
                [
                    'uuid' => \Illuminate\Support\Str::uuid(),
                    'name' => $province['name'],
                ]
            );
        }
    }
}
