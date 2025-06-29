<?php

namespace App\Livewire\Cities;

use App\Models\City;
use App\Models\Province;
use Livewire\Component;


use Livewire\Attributes\On;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    public string $sortBy = 'name';
    public string $sortDirection = 'asc';
    public string $search = '';
    public string $cityToDelete = '';

    public $province = '';
    public $provinces = [];

    public $perPage = 10;



    public function mount()
    {
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
        $this->cityToDelete = $uuid;
    }



    public function delete(): void
    {
        $city = City::where('uuid', $this->cityToDelete)->first();

        if (!$city) {
            return;
        }
        $city->delete();
        $this->dispatch('city-deleted');
        $this->reset('cityToDelete');
    }

    public function render()
    {
        $query = City::query()
            ->with(['province'])
            ->when($this->search, function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('code', 'like', "%{$this->search}%");
            })
            ->when($this->province, fn($q) => $q->where('province_id', $this->province));
        $cities = $query->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.cities.index', compact('cities'));
    }
}
