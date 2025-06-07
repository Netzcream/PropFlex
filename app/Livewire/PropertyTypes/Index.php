<?php

namespace App\Livewire\PropertyTypes;

use Livewire\Component;

use App\Models\PropertyType;
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
    public string $propertyTypeToDelete = '';

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
        $this->propertyTypeToDelete = $uuid;
    }



    public function delete(): void
    {
        $propertyType = PropertyType::where('uuid', $this->propertyTypeToDelete)->first();

        if (!$propertyType) {
            return;
        }

        $propertyType->delete();

        $this->dispatch('property-type-deleted');
        $this->reset('propertyTypeToDelete');
    }



    public function render()
    {
        $query = PropertyType::query()
            ->when(
                $this->search,
                fn($q) =>
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('code', 'like', "%{$this->search}%")
            )
            ;

        $propertyTypes = $query->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);


        return view('livewire.property-types.index', compact('propertyTypes'));
    }
}
