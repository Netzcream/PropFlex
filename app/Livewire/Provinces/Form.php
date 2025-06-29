<?php

namespace App\Livewire\Provinces;


use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Province;


#[Layout('components.layouts.app')]
class Form extends Component
{
    use WithFileUploads;

    // Campos del formulario (todos los del modelo)
    public $province_name;
    public $province_city_id;
    public $province_code;

    public $editMode = false;
    public $province_id = null;


    public function mount(?Province $province)
    {

        if ($province instanceof Province && $province->exists) {
            $this->province_id = $province->id;
            $this->province_name = $province->name;
            $this->province_code = $province->code;
            $this->editMode = true;


        } else {
            $this->editMode = false;

        }
    }



    public function save()
    {
        $this->validate([
            'province_name' => 'required|string|max:255',
            'province_code' => 'nullable|string|max:10',

        ]);

        if ($this->editMode && $this->province_id) {
            $province = Province::findOrFail($this->province_id);
        } else {
            $province = new Province();
        }

        $province->name = $this->province_name;
        $province->code = $this->province_code;
        $province->save();

        session()->flash('success', $this->editMode ? 'Provincia actualizada' : 'Provincia creada');

        return redirect()->route('dashboard.provinces.index');
    }



    public function render()
    {
        return view('livewire.provinces.form');
    }
}
