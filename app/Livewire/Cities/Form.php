<?php

namespace App\Livewire\Cities;

use App\Models\Province;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\City;


#[Layout('components.layouts.app')]
class Form extends Component
{
    use WithFileUploads;

    // Campos del formulario (todos los del modelo)
    public $city_name;
    public $city_province_id;
    public $city_code;

    public $editMode = false;
    public $city_id = null;
    public $provinces = [];

    public function mount(?City $city)
    {
       $this->provinces = Province::orderBy('name')->get()?? collect();

        if ($city instanceof City && $city->exists) {
            $this->city_id = $city->id;
            $this->city_name = $city->name;
            $this->city_province_id = $city->province_id;
            $this->city_code = $city->code;
            $this->editMode = true;


        } else {
            $this->editMode = false;

        }
    }



    public function save()
    {
        $this->validate([
            'city_name' => 'required|string|max:255',
            'city_code' => 'nullable|string|max:10',
            'city_province_id' => 'required|exists:provinces,id',

        ]);

        if ($this->editMode && $this->city_id) {
            $city = City::findOrFail($this->city_id);
        } else {
            $city = new City();
        }

        $city->name = $this->city_name;
        $city->code = $this->city_code;
        $city->province_id = $this->city_province_id;
        $city->save();

        session()->flash('success', $this->editMode ? 'Ciudad actualizada' : 'Ciudad creada');

        return redirect()->route('dashboard.cities.index');
    }



    public function render()
    {
        return view('livewire.cities.form');
    }
}
