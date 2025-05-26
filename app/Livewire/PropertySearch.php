<?php

namespace App\Livewire;

use Livewire\Component;

class PropertySearch extends Component
{
    public $search = '';
    public $type = '';
    public $city = '';

    public function submit()
    {
        $params = [];

        if ($this->search) $params['q'] = $this->search;
        if ($this->type)   $params['type'] = $this->type;
        if ($this->city)   $params['city'] = $this->city;

        $this->redirect(route('properties.index', $params), navigate: true);
    }

    public function render()
    {

        $types = \App\Models\PropertyType::orderBy('name')->get();
        $cities = \App\Models\City::orderBy('name')->get();

        return view('livewire.property-search', [
            'types' => $types,
            'cities' => $cities,
        ]);
    }
}
