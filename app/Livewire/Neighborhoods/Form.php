<?php

namespace App\Livewire\Neighborhoods;

use App\Models\City;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Neighborhood;


#[Layout('components.layouts.app')]
class Form extends Component
{
    use WithFileUploads;

    // Campos del formulario (todos los del modelo)
    public $neighborhood_name;
    public $neighborhood_city_id;
    public $neighborhood_code;

    public $editMode = false;
    public $neighborhood_id = null;
    public $cities = [];

    public function mount(?Neighborhood $neighborhood)
    {
       $this->cities = City::orderBy('name')->get()?? collect();

        if ($neighborhood instanceof Neighborhood && $neighborhood->exists) {
            $this->neighborhood_id = $neighborhood->id;
            $this->neighborhood_name = $neighborhood->name;
            $this->neighborhood_city_id = $neighborhood->city_id;
            $this->neighborhood_code = $neighborhood->code;
            $this->editMode = true;


        } else {
            $this->editMode = false;

        }
    }



    public function save()
    {
        $this->validate([
            'neighborhood_name' => 'required|string|max:255',
            'neighborhood_code' => 'nullable|string|max:10',
            'neighborhood_city_id' => 'required|exists:cities,id',

        ]);

        if ($this->editMode && $this->neighborhood_id) {
            $neighborhood = Neighborhood::findOrFail($this->neighborhood_id);
        } else {
            $neighborhood = new Neighborhood();
        }

        $neighborhood->name = $this->neighborhood_name;
        $neighborhood->code = $this->neighborhood_code;
        $neighborhood->city_id = $this->neighborhood_city_id;
        $neighborhood->save();

        session()->flash('success', $this->editMode ? 'Barrio actualizado' : 'Barrio creado');

        return redirect()->route('dashboard.neighborhoods.index');
    }



    public function render()
    {
        return view('livewire.neighborhoods.form');
    }
}
