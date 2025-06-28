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
use Illuminate\Support\Facades\File;


class PropertySeeder extends Seeder
{
    public function run()
    {
        $storagePath = public_path('storage');
        $items = File::allFiles($storagePath);
        $dirs = File::directories($storagePath);
        foreach ($items as $file) {
            File::delete($file);
        }

        foreach ($dirs as $dir) {
            File::deleteDirectory($dir);
        }

        //Media::truncate();

        $users = User::take(2)->get();

        if ($users->count() < 2) {
            $this->command->error('No hay suficientes usuarios cargados. Creá al menos dos usuarios para asignar propiedades.');
            return;
        }

        $user1 = $users[0];
        $user2 = $users[1];

        $statusDisp = PropertyStatus::where('code', 'DISP')->first();
        $data = [
            // --- CABA ---
            [
                'province' => 'CABA',
                'city' => 'CABA',
                'neigh' => 'PALER',
                'type' => 'DEPTO',
                'op' => 'SALE',
                'code' => 'FP-001',
                'title' => 'Departamento moderno en Palermo',
                'slug'  => 'depto-moderno-palermo',
                'desc'  => 'Luminoso 3 ambientes con balcón y amenities.',
                'price' => 150000,
                'rooms' => 2,
                'baths' => 1,
                'surface' => 55,
                'address' => 'Av. Santa Fe 1234',
                'images' => ['img/properties/palermo/1.png', 'img/properties/palermo/2.png', 'img/properties/palermo/3.png', 'img/properties/palermo/4.png', 'img/properties/palermo/5.png'],
                'plans' => ['img/properties/palermo/plano.png'],
            ],
            [
                'province' => 'CABA',
                'city' => 'CABA',
                'neigh' => 'CABAL',
                'type' => 'DEPTO',
                'op' => 'RENT',
                'code' => 'FP-002',
                'title' => 'Alquiler departamento en Caballito',
                'slug'  => 'alquiler-depto-caballito',
                'desc'  => '2 ambientes, excelente ubicación y bajas expensas.',
                'price' => 500,
                'rooms' => 2,
                'baths' => 1,
                'surface' => 52,
                'address' => 'Av. Rivadavia 4567',
                'images' => ['img/properties/caballito/1.png', 'img/properties/caballito/2.png', 'img/properties/caballito/3.png', 'img/properties/caballito/4.png', 'img/properties/caballito/5.png'],
                'plans' => ['img/properties/caballito/plano.png'],
            ],
            [
                'province' => 'CABA',
                'city' => 'CABA',
                'neigh' => 'BELG',
                'type' => 'CASA',
                'op' => 'SALE',
                'code' => 'FP-003',
                'title' => 'Casa clásica en Belgrano',
                'slug'  => 'casa-clasica-belgrano',
                'desc'  => '4 dormitorios, patio y quincho. Ideal familia grande.',
                'price' => 340000,
                'rooms' => 5,
                'baths' => 2,
                'surface' => 200,
                'address' => 'Virrey Loreto 3001',
                'images' => ['img/properties/belgrano/1.png', 'img/properties/belgrano/2.png', 'img/properties/belgrano/3.png', 'img/properties/belgrano/4.png', 'img/properties/belgrano/5.png'],
                'plans' => ['img/properties/belgrano/plano.png'],
            ],
            [
                'province' => 'CABA',
                'city' => 'CABA',
                'neigh' => 'RECO',
                'type' => 'PH',
                'op' => 'RENT',
                'code' => 'FP-004',
                'title' => 'PH en Recoleta con terraza',
                'slug'  => 'ph-recoleta-terraza',
                'desc'  => '2 dormitorios, cocina americana y terraza propia.',
                'price' => 430,
                'rooms' => 2,
                'baths' => 1,
                'surface' => 70,
                'address' => 'Uruguay 1234',
                'images' => ['img/properties/recoleta/1.png', 'img/properties/recoleta/2.png', 'img/properties/recoleta/3.png', 'img/properties/recoleta/4.png', 'img/properties/recoleta/5.png'],
                'plans' => ['img/properties/recoleta/plano.png'],
            ],
            [
                'province' => 'CABA',
                'city' => 'CABA',
                'neigh' => 'VILLA3',
                'type' => 'CASA',
                'op' => 'SALE',
                'code' => 'FP-005',
                'title' => 'Casa grande en Villa Devoto',
                'slug'  => 'casa-villa-devoto',
                'desc'  => '3 dormitorios, jardín y garage doble.',
                'price' => 370000,
                'rooms' => 3,
                'baths' => 2,
                'surface' => 160,
                'address' => 'Chivilcoy 4002',
                'images' => ['img/properties/devoto/1.png', 'img/properties/devoto/2.png', 'img/properties/devoto/3.png', 'img/properties/devoto/4.png', 'img/properties/devoto/5.png'],
                'plans' => ['img/properties/devoto/plano1.png', 'img/properties/devoto/plano2.png', 'img/properties/devoto/plano3.png'],
            ],
            // --- Provincia de Buenos Aires ---
            [
                'province' => 'BA',
                'city' => 'LP',
                'neigh' => 'CENTRO',
                'type' => 'CASA',
                'op' => 'RENT',
                'code' => 'FP-006',
                'title' => 'Casa amplia en el centro de La Plata',
                'slug'  => 'casa-amplia-centro-la-plata',
                'desc'  => '4 dormitorios, patio grande y garaje para dos autos.',
                'price' => 950,
                'rooms' => 4,
                'baths' => 3,
                'surface' => 180,
                'address' => 'Calle 50 Nº 1123',
                'images' => ['img/properties/la_plata/1.png', 'img/properties/la_plata/2.png', 'img/properties/la_plata/3.png', 'img/properties/la_plata/4.png', 'img/properties/la_plata/5.png'],
                'plans' => ['img/properties/la_plata/plano.png'],
            ],
            [
                'province' => 'BA',
                'city' => 'LP',
                'neigh' => 'NORTE',
                'type' => 'DEPTO',
                'op' => 'SALE',
                'code' => 'FP-007',
                'title' => 'Depto en el Norte de La Plata',
                'slug'  => 'depto-norte-la-plata',
                'desc'  => 'Ambiente único, listo para mudarse, edificio moderno.',
                'price' => 73000,
                'rooms' => 1,
                'baths' => 1,
                'surface' => 38,
                'address' => 'Calle 2 Nº 2345',
                'images' => ['img/properties/la_plata_2/1.png', 'img/properties/la_plata_2/2.png', 'img/properties/la_plata_2/3.png', 'img/properties/la_plata_2/4.png', 'img/properties/la_plata_2/5.png'],
                'plans' => ['img/properties/la_plata_2/plano.png'],
            ],
            [
                'province' => 'BA',
                'city' => 'MDP',
                'neigh' => 'CENTRO',
                'type' => 'DEPTO',
                'op' => 'RENT',
                'code' => 'FP-008',
                'title' => 'Depto frente al mar en Mar del Plata',
                'slug'  => 'depto-mar-mardel',
                'desc'  => '2 ambientes, balcón con vista al mar, cochera.',
                'price' => 520,
                'rooms' => 2,
                'baths' => 1,
                'surface' => 49,
                'address' => 'Boulevard Marítimo 123',
                'images' => ['img/properties/mdq/1.png', 'img/properties/mdq/2.png', 'img/properties/mdq/3.png', 'img/properties/mdq/4.png', 'img/properties/mdq/5.png'],
                'plans' => ['img/properties/mdq/plano.png'],
            ],
            [
                'province' => 'BA',
                'city' => 'MDP',
                'neigh' => 'CENTRO',
                'type' => 'PH',
                'op' => 'SALE',
                'code' => 'FP-009',
                'title' => 'PH en Mar del Plata',
                'slug'  => 'ph-mardel',
                'desc'  => '3 ambientes, patio y parrilla.',
                'price' => 120000,
                'rooms' => 3,
                'baths' => 2,
                'surface' => 77,
                'address' => 'Calle Alem 567',
            ],
            [
                'province' => 'BA',
                'city' => 'BAH',
                'neigh' => 'CENTRO',
                'type' => 'CASA',
                'op' => 'SALE',
                'code' => 'FP-010',
                'title' => 'Casa en Bahía Blanca',
                'slug'  => 'casa-bahia-blanca',
                'desc'  => '3 dormitorios, jardín con pileta.',
                'price' => 160000,
                'rooms' => 3,
                'baths' => 2,
                'surface' => 130,
                'address' => 'Sarmiento 1234',
            ],
            [
                'province' => 'BA',
                'city' => 'PER',
                'neigh' => 'CENTRO',
                'type' => 'OFICINA',
                'op' => 'RENT',
                'code' => 'FP-011',
                'title' => 'Oficina céntrica en Pergamino',
                'slug'  => 'oficina-centro-pergamino',
                'desc'  => 'Oficina equipada, lista para entrar.',
                'price' => 325,
                'rooms' => 1,
                'baths' => 1,
                'surface' => 20,
                'address' => 'Mitre 678',
                'images' => ['img/properties/pergamino/1.png', 'img/properties/pergamino/2.png', 'img/properties/pergamino/3.png', 'img/properties/pergamino/4.png', 'img/properties/pergamino/5.png'],
                'plans' => ['img/properties/pergamino/plano.png'],
            ],
        ];
        $userIds = [$user1->id, $user2->id];


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

        foreach ($data as $item) {
            $province = Province::where('code', $item['province'])->first();
            $city = City::where('code', $item['city'])->first();
            $neigh = $item['neigh'] ? Neighborhood::where('code', $item['neigh'])->where('city_id', $city?->id)->first() : null;
            $type = PropertyType::where('code', $item['type'])->first();
            $op   = PropertyOperationType::where('code', $item['op'])->first();

            if ($province && $city && $type && $op && $statusDisp) {
                $property = Property::create([
                    'user_id'                    => $userIds[array_rand($userIds)],
                    'uuid'                       => Str::uuid(),
                    'title'                      => $item['title'],
                    'code'                      => $item['code'],
                    'description'                => $item['desc'],
                    'price'                      => $item['price'],
                    'currency'                   => $item['currency'] ?? 'USD',
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

                if (!empty($item['images'])) {
                    foreach ($item['images'] as $imgPath) {
                        $fullPath = public_path($imgPath);
                        if (file_exists($fullPath)) {
                            $property->addMedia($fullPath)->preservingOriginal()->toMediaCollection('photos');
                        }
                    }
                }

                // Asociar planos
                if (!empty($item['plans'])) {
                    foreach ($item['plans'] as $planPath) {
                        $fullPath = public_path($planPath);
                        if (file_exists($fullPath)) {
                            $property->addMedia($fullPath)->preservingOriginal()->toMediaCollection('plans');
                        }
                    }
                }
            } else {
                $this->command->error("No se pudo crear la propiedad: {$item['title']}. Verifica que existan provincia, ciudad, tipo de propiedad y tipo de operación. ");

                 $this->command->error("Faltan datos: Provincia: {$province?->code}, Ciudad: {$city?->code}, Tipo: {$type?->code}, Operación: {$op?->code}, Estado: {$statusDisp?->code}");

            }
        }

        // Después de cargar los barrios específicos...


    }
}
