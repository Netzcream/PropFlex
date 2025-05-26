<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyOperationTypeSeeder extends Seeder
{



    public function run()
    {
        $types = [

            [
                'code' => 'SALE',
                'name' => 'Venta'
            ],
            [
                'code' => 'RENT',
                'name' => 'Alquiler'
            ],
            [
                'code' => 'TEMP',
                'name' => 'Alquiler temporario'
            ],
        ];




        foreach ($types as $type) {
            \App\Models\PropertyOperationType::firstOrCreate(
                ['code' => $type['code']], // valores de búsqueda (clave única)
                [
                    'name' => $type['name'],
                    'uuid' => \Illuminate\Support\Str::uuid(),
                ] // valores para crear si no existe
            );
        }
    }
}
