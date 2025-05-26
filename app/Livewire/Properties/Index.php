<?php

namespace App\Livewire\Properties;

use Livewire\Component;
use App\Models\Property;
use Livewire\Attributes\On;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    public string $sortBy = 'title';
    public string $sortDirection = 'asc';
    public string $search = '';
    public string $propertyToDelete = '';

    public $status = '';
    public $type = '';
    public $operation = '';
    public $city = '';
    public $is_featured = null;
    public $perPage = 5;


    public $propertyTypes = [];
    public $propertyOperationTypes = [];
    public $propertyStatuses = [];

    public function mount()
    {
        $this->propertyTypes = \App\Models\PropertyType::orderBy('name')->get();
        $this->propertyOperationTypes = \App\Models\PropertyOperationType::orderBy('name')->get();
        $this->propertyStatuses = \App\Models\PropertyStatus::orderBy('name')->get();
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
        $this->propertyToDelete = $uuid;
    }



    public function delete(): void
    {
        $property = Property::where('uuid', $this->propertyToDelete)->first();

        if (!$property) {
            return;
        }

        /** @var User $user */
        $user = Auth::user();

        if (!($user->isAdmin() || $property->user_id === $user->id)) {
            abort(403); // O lanza un error custom/flash
        }

        $property->delete();

        $this->dispatch('property-deleted');
        $this->reset('propertyToDelete');
    }

    public function toggleFeatured($uuid)
    {
        $property = Property::where('uuid', $uuid)->firstOrFail();

        /** @var User $user */
        $user = Auth::user();


        // Solo admin o dueño puede cambiar
        if (!($user->isAdmin() || $property->user_id === $user->id)) {
            abort(403);
        }

        $property->is_featured = !$property->is_featured;
        $property->save();
    }

    public function render()
    {
        $query = Property::query()
            ->with(['user', 'propertyType', 'propertyOperationType', 'propertyStatus', 'province', 'city', 'neighborhood'])
            ->when(
                $this->search,
                fn($q) =>
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('address', 'like', "%{$this->search}%")
            )
            ->when($this->status, fn($q) => $q->where('property_status_id', $this->status))
            ->when($this->type, fn($q) => $q->where('property_type_id', $this->type))
            ->when($this->operation, fn($q) => $q->where('property_operation_type_id', $this->operation))
            ->when($this->city, fn($q) => $q->where('city_id', $this->city))
            ->when(!is_null($this->is_featured), fn($q) => $q->where('is_featured', $this->is_featured));

        $properties = $query->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);


        return view('livewire.properties.index', compact('properties'));
    }
}
