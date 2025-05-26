<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\User;
use App\Models\Province;
use App\Models\City;
use App\Models\Neighborhood;
use App\Models\PropertyType;
use App\Models\PropertyOperationType;
use App\Models\PropertyStatus;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        if (!$user) {
            $this->command->error('No hay usuarios cargados. Crea al menos un usuario para asignar propiedades.');
            return;
        }

        $statusDisp = PropertyStatus::where('code', 'DISP')->first();
        $data = [
            // --- CABA ---
            [
                'province' => 'CABA', 'city' => 'CABA', 'neigh' => 'PALER', 'type' => 'DEPTO', 'op' => 'SALE',
                'code' => 'FP-001',
                'title' => 'Departamento moderno en Palermo',
                'slug'  => 'depto-moderno-palermo',
                'desc'  => 'Luminoso 3 ambientes con balcón y amenities.',
                'price' => 150000, 'rooms' => 3, 'baths' => 2, 'surface' => 80, 'address' => 'Av. Santa Fe 1234',
            ],
            [
                'province' => 'CABA', 'city' => 'CABA', 'neigh' => 'CABAL', 'type' => 'DEPTO', 'op' => 'RENT',
                'code' => 'FP-002',
                'title' => 'Alquiler departamento en Caballito',
                'slug'  => 'alquiler-depto-caballito',
                'desc'  => '2 ambientes, excelente ubicación y bajas expensas.',
                'price' => 500, 'rooms' => 2, 'baths' => 1, 'surface' => 52, 'address' => 'Av. Rivadavia 4567',
            ],
            [
                'province' => 'CABA', 'city' => 'CABA', 'neigh' => 'BELG', 'type' => 'CASA', 'op' => 'SALE',
                'code' => 'FP-003',
                'title' => 'Casa clásica en Belgrano',
                'slug'  => 'casa-clasica-belgrano',
                'desc'  => '4 dormitorios, patio y quincho. Ideal familia grande.',
                'price' => 340000, 'rooms' => 5, 'baths' => 2, 'surface' => 200, 'address' => 'Virrey Loreto 3001',
            ],
            [
                'province' => 'CABA', 'city' => 'CABA', 'neigh' => 'RECO', 'type' => 'PH', 'op' => 'RENT',
                'code' => 'FP-004',
                'title' => 'PH en Recoleta con terraza',
                'slug'  => 'ph-recoleta-terraza',
                'desc'  => '2 dormitorios, cocina americana y terraza propia.',
                'price' => 430, 'rooms' => 2, 'baths' => 1, 'surface' => 70, 'address' => 'Uruguay 1234',
            ],
            [
                'province' => 'CABA', 'city' => 'CABA', 'neigh' => 'VILLA3', 'type' => 'CASA', 'op' => 'SALE',
                'code' => 'FP-005',
                'title' => 'Casa grande en Villa Devoto',
                'slug'  => 'casa-villa-devoto',
                'desc'  => '3 dormitorios, jardín y garage doble.',
                'price' => 370000, 'rooms' => 3, 'baths' => 2, 'surface' => 160, 'address' => 'Chivilcoy 4002',
            ],
            // --- Provincia de Buenos Aires ---
            [
                'province' => 'BA', 'city' => 'LP', 'neigh' => 'CENTRO', 'type' => 'CASA', 'op' => 'RENT',
                'code' => 'FP-006',
                'title' => 'Casa amplia en el centro de La Plata',
                'slug'  => 'casa-amplia-centro-la-plata',
                'desc'  => '4 dormitorios, patio grande y garaje para dos autos.',
                'price' => 950, 'rooms' => 4, 'baths' => 3, 'surface' => 180, 'address' => 'Calle 50 Nº 1123',
            ],
            [
                'province' => 'BA', 'city' => 'LP', 'neigh' => 'NORTE', 'type' => 'DEPTO', 'op' => 'SALE',
                'code' => 'FP-007',
                'title' => 'Depto en el Norte de La Plata',
                'slug'  => 'depto-norte-la-plata',
                'desc'  => 'Ambiente único, listo para mudarse, edificio moderno.',
                'price' => 73000, 'rooms' => 1, 'baths' => 1, 'surface' => 38, 'address' => 'Calle 2 Nº 2345',
            ],
            [
                'province' => 'BA', 'city' => 'MDP', 'neigh' => 'CENTRO', 'type' => 'DEPTO', 'op' => 'RENT',
                'code' => 'FP-008',
                'title' => 'Depto frente al mar en Mar del Plata',
                'slug'  => 'depto-mar-mardel',
                'desc'  => '2 ambientes, balcón con vista al mar, cochera.',
                'price' => 520, 'rooms' => 2, 'baths' => 1, 'surface' => 49, 'address' => 'Boulevard Marítimo 123',
            ],
            [
                'province' => 'BA', 'city' => 'MDP', 'neigh' => 'CENTRO', 'type' => 'PH', 'op' => 'SALE',
                'code' => 'FP-009',
                'title' => 'PH en Mar del Plata',
                'slug'  => 'ph-mardel',
                'desc'  => '3 ambientes, patio y parrilla.',
                'price' => 120000, 'rooms' => 3, 'baths' => 2, 'surface' => 77, 'address' => 'Calle Alem 567',
            ],
            [
                'province' => 'BA', 'city' => 'BAH', 'neigh' => 'CENTRO', 'type' => 'CASA', 'op' => 'SALE',
                'code' => 'FP-010',
                'title' => 'Casa en Bahía Blanca',
                'slug'  => 'casa-bahia-blanca',
                'desc'  => '3 dormitorios, jardín con pileta.',
                'price' => 160000, 'rooms' => 3, 'baths' => 2, 'surface' => 130, 'address' => 'Sarmiento 1234',
            ],
            [
                'province' => 'BA', 'city' => 'PER', 'neigh' => 'CENTRO', 'type' => 'OFIC', 'op' => 'RENT',
                'code' => 'FP-011',
                'title' => 'Oficina céntrica en Pergamino',
                'slug'  => 'oficina-centro-pergamino',
                'desc'  => 'Oficina equipada, lista para entrar.',
                'price' => 325, 'rooms' => 1, 'baths' => 1, 'surface' => 20, 'address' => 'Mitre 678',
            ],
        ];

        foreach ($data as $item) {
            $province = Province::where('code', $item['province'])->first();
            $city = City::where('code', $item['city'])->first();
            $neigh = $item['neigh'] ? Neighborhood::where('code', $item['neigh'])->where('city_id', $city?->id)->first() : null;
            $type = PropertyType::where('code', $item['type'])->first();
            $op   = PropertyOperationType::where('code', $item['op'])->first();

            if ($province && $city && $type && $op && $statusDisp) {
                Property::create([
                    'user_id'                    => $user->id,
                    'uuid'                       => Str::uuid(),
                    'title'                      => $item['title'],
                    'code'                      => $item['code'],
                    'description'                => $item['desc'],
                    'price'                      => $item['price'],
                    'currency'                   => $item['currency']??'USD',
                    'province_id'                => $province->id,
                    'city_id'                    => $city->id,
                    'neighborhood_id'            => $neigh?->id,
                    'address'                    => $item['address'],
                    'property_type_id'           => $type->id,
                    'property_operation_type_id' => $op->id,
                    'property_status_id'         => $statusDisp->id,
                    'rooms'                      => $item['rooms'],
                    'bathrooms'                  => $item['baths'],
                    'surface'                    => $item['surface'],
                    'slug'                       => $item['slug'],
                    'is_published'               => true,
                    'published_at'               => now(),
                    'is_featured' => random_int(1, 100) <= 30,

                ]);
            }
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
