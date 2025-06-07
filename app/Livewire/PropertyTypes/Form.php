<?php

namespace App\Livewire\PropertyTypes;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;


#[Layout('components.layouts.app')]
class Form extends Component
{
    use WithFileUploads;

    // Campos del formulario (todos los del modelo)
    public $property_type_name;
    public $property_type_code;
    public $property_type_icon;

    public $editMode = false;
    public $property_type_id = null;

    public function mount(?PropertyType $property)
    {


        if ($property instanceof PropertyType && $property->exists) {
            $this->property_type_id = $property->id;
            $this->property_type_name = $property->name;
            $this->property_type_code = $property->code;
            $this->property_type_icon = $property->icon;

            $this->editMode = true;


        } else {
            $this->editMode = false;

        }
    }



    public function save()
    {
        $this->validate([
            'property_type_name' => 'required|string|max:255',
            'property_type_code' => 'nullable|string|max:10',
            'property_type_icon' => 'nullable|string',

        ]);

        if ($this->editMode && $this->property_type_id) {
            $property = PropertyType::findOrFail($this->property_type_id);
        } else {
            $property = new PropertyType();
        }

        $property->name = $this->property_type_name;
        $property->code = $this->property_type_code;
        $property->icon = $this->property_type_icon;
        $property->save();

        session()->flash('success', $this->editMode ? 'Tipo de propiedad actualizada' : 'Tipo de propiedad creada');

        return redirect()->route('dashboard.property-types.index');
    }



    public function render()
    {
        return view('livewire.property-types.form');
    }
}
