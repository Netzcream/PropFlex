<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NeighborhoodSeeder extends Seeder
{
    public function run()
    {
        // Barrios de La Plata
        $city = \App\Models\City::where('code', 'LP')->first();

        $neighborhoodsLP = [
            ['code' => 'CENTRO', 'name' => 'Centro'],
            ['code' => 'NORTE',  'name' => 'Norte'],
            ['code' => 'SUR',    'name' => 'Sur'],
            ['code' => 'OESTE',  'name' => 'Oeste'],
            ['code' => 'ESTE',   'name' => 'Este'],
            ['code' => 'RURAL',  'name' => 'Rural'],
        ];

        foreach ($neighborhoodsLP as $hood) {
            \App\Models\Neighborhood::firstOrCreate(
                [
                    'code' => $hood['code'],
                    'city_id' => $city->id,
                ],
                [
                    'uuid' => \Illuminate\Support\Str::uuid(),
                    'name' => $hood['name'],
                ]
            );
        }

        // Barrios de CABA
        $city = \App\Models\City::where('code', 'CABA')->first();

        $neighborhoodsCABA = [
            ['code' => 'AGRO',     'name' => 'Agronomía'],
            ['code' => 'ALBE',     'name' => 'Almagro'],
            ['code' => 'BALV',     'name' => 'Balvanera'],
            ['code' => 'BARR',     'name' => 'Barracas'],
            ['code' => 'BELG',     'name' => 'Belgrano'],
            ['code' => 'BOCA',     'name' => 'Boca'],
            ['code' => 'BOED',     'name' => 'Boedo'],
            ['code' => 'CABAL',    'name' => 'Caballito'],
            ['code' => 'CHAC',     'name' => 'Chacarita'],
            ['code' => 'COGHL',    'name' => 'Coghlan'],
            ['code' => 'COLE',     'name' => 'Colegiales'],
            ['code' => 'CONS',     'name' => 'Constitución'],
            ['code' => 'FLORE',    'name' => 'Flores'],
            ['code' => 'FLORESTA', 'name' => 'Floresta'],
            ['code' => 'LINIE',    'name' => 'Liniers'],
            ['code' => 'MATAD',    'name' => 'Mataderos'],
            ['code' => 'MONS',     'name' => 'Monserrat'],
            ['code' => 'MONTEC',   'name' => 'Monte Castro'],
            ['code' => 'NUNEZ',    'name' => 'Núñez'],
            ['code' => 'PALER',    'name' => 'Palermo'],
            ['code' => 'PARQUEC',  'name' => 'Parque Chacabuco'],
            ['code' => 'PARQUEP',  'name' => 'Parque Patricios'],
            ['code' => 'PATERNAL', 'name' => 'Paternal'],
            ['code' => 'PUERTOM',  'name' => 'Puerto Madero'],
            ['code' => 'RECO',     'name' => 'Recoleta'],
            ['code' => 'RETIRO',   'name' => 'Retiro'],
            ['code' => 'SAAVEDRA', 'name' => 'Saavedra'],
            ['code' => 'SANCRIS',  'name' => 'San Cristóbal'],
            ['code' => 'SANNIC',   'name' => 'San Nicolás'],
            ['code' => 'SANTELMO', 'name' => 'San Telmo'],
            ['code' => 'VE',       'name' => 'Vélez Sársfield'],
            ['code' => 'VERSA',    'name' => 'Versalles'],
            ['code' => 'VILLA1',   'name' => 'Villa Crespo'],
            ['code' => 'VILLA2',   'name' => 'Villa del Parque'],
            ['code' => 'VILLA3',   'name' => 'Villa Devoto'],
            ['code' => 'VILLA4',   'name' => 'Villa General Mitre'],
            ['code' => 'VILLA5',   'name' => 'Villa Lugano'],
            ['code' => 'VILLA6',   'name' => 'Villa Luro'],
            ['code' => 'VILLA7',   'name' => 'Villa Ortúzar'],
            ['code' => 'VILLA8',   'name' => 'Villa Pueyrredón'],
            ['code' => 'VILLA9',   'name' => 'Villa Real'],
            ['code' => 'VILLA10',  'name' => 'Villa Riachuelo'],
            ['code' => 'VILLA11',  'name' => 'Villa Santa Rita'],
            ['code' => 'VILLA12',  'name' => 'Villa Soldati'],
            ['code' => 'VILLA13',  'name' => 'Villa Urquiza'],
            ['code' => 'VILLAGRAL', 'name' => 'Villa General Mitre'],
            ['code' => 'PARQUEA',  'name' => 'Parque Avellaneda'],
            ['code' => 'PARQUECH', 'name' => 'Parque Chas'],
            ['code' => 'VILLA15',  'name' => 'Villa Santa Rita'],
        ];

        foreach ($neighborhoodsCABA as $hood) {
            \App\Models\Neighborhood::firstOrCreate(
                [
                    'code' => $hood['code'],
                    'city_id' => $city->id,
                ],
                [
                    'uuid' => \Illuminate\Support\Str::uuid(),
                    'name' => $hood['name'],
                ]
            );
        }


        // Después de cargar los barrios específicos...

        // Agregá un barrio "CENTRO" a toda ciudad que no tenga ninguno.
        $allCities = \App\Models\City::all();
        foreach ($allCities as $city) {
            $hasNeighborhood = \App\Models\Neighborhood::where('city_id', $city->id)->exists();
            if (! $hasNeighborhood) {
                \App\Models\Neighborhood::firstOrCreate(
                    [
                        'code' => 'CENTRO',
                        'city_id' => $city->id,
                    ],
                    [
                        'uuid' => \Illuminate\Support\Str::uuid(),
                        'name' => 'Centro',
                    ]
                );
            }
        }
    }
}
