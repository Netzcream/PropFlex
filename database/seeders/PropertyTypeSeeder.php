<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    public function run()
    {
        $types = [
            ['code' => 'CASA',     'name' => 'Casa'],
            ['code' => 'DEPTO',    'name' => 'Departamento'],
            ['code' => 'PH',       'name' => 'PH'],
            ['code' => 'LOTE',     'name' => 'Lote'],
            ['code' => 'OFICINA',  'name' => 'Oficina'],
            ['code' => 'LOCAL',    'name' => 'Local comercial'],
            ['code' => 'EDIF',     'name' => 'Edificio'],
            ['code' => 'CABANA',   'name' => 'Cabaña'],
            ['code' => 'DUPLEX',   'name' => 'Duplex'],
            ['code' => 'TRIPLEX',  'name' => 'Triplex'],
            ['code' => 'GARAGE',   'name' => 'Garaje'],
            ['code' => 'LOFT',     'name' => 'Loft'],
        ];


        foreach ($types as $type) {
            \App\Models\PropertyType::firstOrCreate(
                ['code' => $type['code']],
                [
                    'name' => $type['name'],
                    'uuid' => \Illuminate\Support\Str::uuid(),
                ]
            );
        }
    }
}
