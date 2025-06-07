<?php

namespace App\Livewire\PropertyFeatures;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyFeature;


#[Layout('components.layouts.app')]
class Form extends Component
{
    use WithFileUploads;

    // Campos del formulario (todos los del modelo)
    public $property_feature_name;
    public $property_feature_code;
    public $property_feature_icon;

    public $editMode = false;
    public $property_feature_id = null;

    public function mount(?PropertyFeature $property)
    {


        if ($property instanceof PropertyFeature && $property->exists) {
            $this->property_feature_id = $property->id;
            $this->property_feature_name = $property->name;
            $this->property_feature_code = $property->code;
            $this->property_feature_icon = $property->icon;

            $this->editMode = true;


        } else {
            $this->editMode = false;

        }
    }



    public function save()
    {
        $this->validate([
            'property_feature_name' => 'required|string|max:255',
            'property_feature_code' => 'nullable|string|max:10',
            'property_feature_icon' => 'nullable|string',

        ]);

        if ($this->editMode && $this->property_feature_id) {
            $property = PropertyFeature::findOrFail($this->property_feature_id);
        } else {
            $property = new PropertyFeature();
        }

        $property->name = $this->property_feature_name;
        $property->code = $this->property_feature_code;
        $property->icon = $this->property_feature_icon;
        $property->save();

        session()->flash('success', $this->editMode ? 'Característica actualizada' : 'Característica creada');

        return redirect()->route('dashboard.property-features.index');
    }



    public function render()
    {
        return view('livewire.property-features.form');
    }
}
