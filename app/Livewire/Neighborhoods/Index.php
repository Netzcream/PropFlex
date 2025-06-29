<?php

namespace App\Livewire\Neighborhoods;

use App\Models\City;
use Livewire\Component;
use App\Models\Province;
use App\Models\Neighborhood;
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
    public string $neighborhoodToDelete = '';
    public $city = '';
    public $cities = [];
    public $province = '';
    public $provinces = [];

    public $perPage = 10;



    public function mount()
    {
        $this->cities = City::orderBy('name')->get();
        $this->provinces = Province::orderBy('name')->get();
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
        $this->neighborhoodToDelete = $uuid;
    }



    public function delete(): void
    {
        $neighborhood = Neighborhood::where('uuid', $this->neighborhoodToDelete)->first();

        if (!$neighborhood) {
            return;
        }
        $neighborhood->delete();
        $this->dispatch('neighborhood-deleted');
        $this->reset('neighborhoodToDelete');
    }

    public function render()
    {
        $query = Neighborhood::query()
            ->with(['city'])
            ->when($this->search, function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('code', 'like', "%{$this->search}%");
            })
            ->when($this->city, fn($q) => $q->where('city_id', $this->city));
        $neighborhoods = $query->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.neighborhoods.index', compact('neighborhoods'));
    }
}
