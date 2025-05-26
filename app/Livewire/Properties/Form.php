<?php

namespace App\Livewire\Properties;

use Livewire\Component;
use App\Models\Property;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;
use App\Models\PropertyOperationType;
use App\Models\PropertyStatus;
use App\Models\Province;
use App\Models\City;
use App\Models\Neighborhood;

#[Layout('components.layouts.app')]
class Form extends Component
{
    use WithFileUploads;

    // Campos del formulario (todos los del modelo)
    public $property_title;
    public $property_description;
    public $property_price;
    public $property_currency = 'USD';
    public $property_type_id;
    public $property_operation_type_id;
    public $property_status_id;
    public $property_address;
    public $property_province_id;
    public $property_city_id;
    public $property_neighborhood_id;
    public $property_rooms;
    public $property_bathrooms;
    public $property_surface;
    public $property_latitude;
    public $property_longitude;
    public $property_is_featured = false;
    public $property_is_published = true;
    public $property_published_at;
    public $property_expires_at;

    public $photo_files = [];
    public $plan_files = [];

    public $propertyTypes = [];
    public $propertyOperationTypes = [];
    public $propertyStatuses = [];
    public $provinces = [];
    public $cities = [];
    public $neighborhoods = [];

    public $editMode = false;
    public $property_id = null;

    public function mount(?Property $property)
    {
        $this->propertyTypes = PropertyType::orderBy('name')->get();
        $this->propertyOperationTypes = PropertyOperationType::orderBy('name')->get();
        $this->propertyStatuses = PropertyStatus::orderBy('name')->get();
        $this->provinces = Province::orderBy('name')->get();

        if ($property instanceof Property && $property->exists) {
            $this->property_id = $property->id;
            $this->property_title = $property->title;
            $this->property_description = $property->description;
            $this->property_price = $property->price;
            $this->property_currency = $property->currency;
            $this->property_type_id = $property->property_type_id;
            $this->property_operation_type_id = $property->property_operation_type_id;
            $this->property_status_id = $property->property_status_id;
            $this->property_address = $property->address;
            $this->property_province_id = $property->province_id;
            $this->property_city_id = $property->city_id;
            $this->property_neighborhood_id = $property->neighborhood_id;
            $this->property_rooms = $property->rooms;
            $this->property_bathrooms = $property->bathrooms;
            $this->property_surface = $property->surface;
            $this->property_latitude = $property->latitude;
            $this->property_longitude = $property->longitude;
            $this->property_is_featured = $property->is_featured;
            $this->property_is_published = $property->is_published;
            $this->property_published_at = $property->published_at ? $property->published_at->format('Y-m-d') : null;
            $this->property_expires_at = $property->expires_at ? $property->expires_at->format('Y-m-d') : null;

            $this->editMode = true;

            $this->cities = $this->property_province_id
                ? City::where('province_id', $this->property_province_id)->orderBy('name')->get()
                : collect();
            $this->neighborhoods = $this->property_city_id
                ? Neighborhood::where('city_id', $this->property_city_id)->orderBy('name')->get()
                : collect();
        } else {
            $this->editMode = false;
            $this->cities = collect();
            $this->neighborhoods = collect();
        }
    }

    public function updatedPropertyProvinceId()
    {
        $this->cities = $this->property_province_id
            ? City::where('province_id', $this->property_province_id)->orderBy('name')->get()
            : collect();
        $this->property_city_id = null;
        $this->neighborhoods = collect();
        $this->property_neighborhood_id = null;
    }

    public function updatedPropertyCityId()
    {
        $this->neighborhoods = $this->property_city_id
            ? Neighborhood::where('city_id', $this->property_city_id)->orderBy('name')->get()
            : collect();
        $this->property_neighborhood_id = null;
    }

    public function save()
    {
        $this->validate([
            'property_title' => 'required|string|max:255',
            'property_description' => 'nullable|string',
            'property_price' => 'required|numeric',
            'property_currency' => 'required|string|max:5',
            'property_type_id' => 'required|exists:property_types,id',
            'property_operation_type_id' => 'required|exists:property_operation_types,id',
            'property_status_id' => 'required|exists:property_statuses,id',
            'property_province_id' => 'nullable|exists:provinces,id',
            'property_city_id' => 'nullable|exists:cities,id',
            'property_neighborhood_id' => 'nullable|exists:neighborhoods,id',
            'property_rooms' => 'nullable|integer|min:0',
            'property_bathrooms' => 'nullable|integer|min:0',
            'property_surface' => 'nullable|numeric|min:0',
            'property_address' => 'nullable|string|max:255',
            'property_latitude' => 'nullable|string',
            'property_longitude' => 'nullable|string',
            'property_is_featured' => 'boolean',
            'property_is_published' => 'boolean',
            'property_published_at' => 'nullable|date',
            'property_expires_at' => 'nullable|date',
            'photo_files.*' => 'nullable|image|max:4096',
            'plan_files.*' => 'nullable|file|max:4096',
        ]);

        if ($this->editMode && $this->property_id) {
            $property = Property::findOrFail($this->property_id);
        } else {
            $property = new Property();
            $property->user_id = Auth::id();
        }

        $property->title = $this->property_title;
        $property->description = $this->property_description;
        $property->price = $this->property_price;
        $property->currency = $this->property_currency;
        $property->property_type_id = $this->property_type_id;
        $property->property_operation_type_id = $this->property_operation_type_id;
        $property->property_status_id = $this->property_status_id;
        $property->address = $this->property_address;
        $property->province_id = $this->property_province_id;
        $property->city_id = $this->property_city_id;
        $property->neighborhood_id = $this->property_neighborhood_id;
        $property->rooms = $this->property_rooms;
        $property->bathrooms = $this->property_bathrooms;
        $property->surface = $this->property_surface;
        $property->latitude = $this->property_latitude;
        $property->longitude = $this->property_longitude;
        $property->is_featured = $this->property_is_featured ?? false;
        $property->is_published = $this->property_is_published ?? false;
        $property->published_at = $this->property_published_at;
        $property->expires_at = $this->property_expires_at;

        $property->save();

        foreach ($this->photo_files as $photo) {
            $property->addMedia($photo->getRealPath())->toMediaCollection('photos');
        }
        foreach ($this->plan_files as $plan) {
            $property->addMedia($plan->getRealPath())->toMediaCollection('plans');
        }

        session()->flash('success', $this->editMode ? 'Propiedad actualizada' : 'Propiedad creada');

        return redirect()->route('dashboard.properties.index');
    }

    public function render()
    {
        return view('livewire.properties.form');
    }
}
