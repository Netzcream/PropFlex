<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PropertyFeatureSeeder extends Seeder
{
    public function run()
    {
        $features = [
            ['code' => 'GARAGE',            'name' => 'Garage'],
            ['code' => 'AIRE',              'name' => 'Aire acondicionado'],
            ['code' => 'MASCOTAS',          'name' => 'Acepta mascotas'],
            ['code' => 'BALCON',            'name' => 'Balcón'],
            ['code' => 'ASCENSOR',          'name' => 'Ascensor'],
            ['code' => 'PISCINA',           'name' => 'Piscina'],
            ['code' => 'JARDIN',            'name' => 'Jardín'],
            ['code' => 'CALEFACCION',       'name' => 'Calefacción'],
            ['code' => 'TERRAZA',           'name' => 'Terraza'],
            ['code' => 'AMUEBLADO',         'name' => 'Amueblado'],
            ['code' => 'COCINA_EQUIPADA',   'name' => 'Cocina equipada'],
            ['code' => 'LAVADERO',          'name' => 'Lavadero'],
            ['code' => 'VIGILANCIA',        'name' => 'Vigilancia 24 horas'],
            ['code' => 'GYM',               'name' => 'Gimnasio'],
            ['code' => 'SAUNA',             'name' => 'Sauna'],
            ['code' => 'JUEGOS',            'name' => 'Sala de juegos'],
            ['code' => 'CAMARAS',           'name' => 'Cámaras de seguridad'],
            ['code' => 'ALARMA',            'name' => 'Sistema de alarma'],
            ['code' => 'INTERNET',          'name' => 'Internet de alta velocidad'],
            ['code' => 'SMARTHOME',         'name' => 'Smart home'],
            ['code' => 'RIEGO',             'name' => 'Sistema de riego automático'],
            ['code' => 'COCINA_EXTERIOR',   'name' => 'Cocina al aire libre'],
            ['code' => 'BARRA',             'name' => 'Zona de bar'],
        ];

        foreach ($features as $feature) {
            \App\Models\PropertyFeature::firstOrCreate(
                ['code' => $feature['code']],
                [
                    'name' => $feature['name'],
                    'uuid' => \Illuminate\Support\Str::uuid(),
                ]
            );
        }
    }
}
