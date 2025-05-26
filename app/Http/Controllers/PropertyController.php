<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\PropertyVisit;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Property::query()->where('is_published', true);

        if ($request->filled('q')) {
            $query->where(function ($q2) use ($request) {
                $q2->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('description', 'like', '%' . $request->q . '%')
                    ->orWhereHas('city', fn($c) => $c->where('name', 'like', '%' . $request->q . '%'))
                    ->orWhereHas('neighborhood', fn($n) => $n->where('name', 'like', '%' . $request->q . '%'));
            });
        }

        if ($request->filled('type')) {
            $type = \App\Models\PropertyType::where('uuid', $request->type)
                ->orWhere('code', $request->type)->first();

            if ($type) $query->where('property_type_id', $type->id);
        }

        if ($request->filled('city')) {
            $city = \App\Models\City::where('uuid', $request->city)
                ->orWhere('code', $request->city)->first();

            if ($city) $query->where('city_id', $city->id);
        }

        if ($request->filled('operation')) {
            $op = \App\Models\PropertyOperationType::where('uuid', $request->operation)
                ->orWhere('code', $request->operation)
                ->first();

            if ($op) $query->where('property_operation_type_id', $op->id);
        }

        if ($request->filled('min')) {
            $query->where('price', '>=', $request->min);
        }
        if ($request->filled('max')) {
            $query->where('price', '<=', $request->max);
        }


        $recentIds = session('recently_viewed', []);

        $onlyRecent = $request->boolean('is_recent');

        if ($onlyRecent && !empty($recentIds)) {
            $query->whereIn('id', $recentIds);

            $idsOrder = implode(',', $recentIds);
            $query->orderByRaw("FIELD(id, $idsOrder)");
        } elseif (!$onlyRecent && !empty($recentIds)) {
            $idsOrder = implode(',', $recentIds);
            $query->orderByRaw("FIELD(id, $idsOrder) DESC");
        }


        $properties = $query->with(['city', 'neighborhood'])->paginate(9);
        $types = \App\Models\PropertyType::orderBy('name')->get();
        $operations = \App\Models\PropertyOperationType::orderBy('name')->get();
        $cities = \App\Models\City::orderBy('name')->get();



        $recentMap = array_flip($recentIds);

        return view('properties.index', compact('properties', 'types', 'operations', 'cities', 'recentMap', 'onlyRecent'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $viewed = session('recently_viewed', []);

        $viewed = array_diff($viewed, [$property->id]);
        $viewed[] = $property->id;
        session(['recently_viewed' => array_slice($viewed, -10)]);

        $ip = request()->ip();
        PropertyVisit::firstOrCreate([
            'property_id' => $property->id,
            'ip_address' => $ip,
        ]);


        return view('properties.show', ['property' => $property]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
