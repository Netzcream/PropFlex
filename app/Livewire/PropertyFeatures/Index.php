<?php

namespace App\Livewire\PropertyFeatures;

use Livewire\Component;

use App\Models\PropertyFeature;
use Livewire\Attributes\On;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

/*
'name', 'code', 'icon', 'uuid'
*/

    public string $sortBy = 'name';
    public string $sortDirection = 'asc';
    public string $search = '';
    public string $propertyFeatureToDelete = '';

    public $perPage = 5;



    public function mount()
    {
    }

    public function sort(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }
    public function filter()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete(string $uuid): void
    {
        $this->propertyFeatureToDelete = $uuid;
    }



    public function delete(): void
    {
        $PropertyFeature = PropertyFeature::where('uuid', $this->propertyFeatureToDelete)->first();

        if (!$PropertyFeature) {
            return;
        }

        $PropertyFeature->delete();

        $this->dispatch('property-feature-deleted');
        $this->reset('propertyFeatureToDelete');
    }



    public function render()
    {
        $query = PropertyFeature::query()
            ->when(
                $this->search,
                fn($q) =>
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('code', 'like', "%{$this->search}%")
            )
            ;

        $propertyFeatures = $query->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);


        return view('livewire.property-features.index', compact('propertyFeatures'));
    }
}
