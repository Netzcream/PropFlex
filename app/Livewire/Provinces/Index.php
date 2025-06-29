<?php

namespace App\Livewire\Provinces;

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

    public string $title = 'Provincias';

    public string $sortBy = 'name';
    public string $sortDirection = 'asc';
    public string $search = '';
    public string $provinceToDelete = '';


    public $perPage = 10;



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
        $this->provinceToDelete = $uuid;
    }



    public function delete(): void
    {
        $province = Province::where('uuid', $this->provinceToDelete)->first();

        if (!$province) {
            return;
        }
        $province->delete();
        $this->dispatch('province-deleted');
        $this->reset('provinceToDelete');
    }

    public function render()
    {
        $query = Province::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('code', 'like', "%{$this->search}%");
            });
        $provinces = $query->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.provinces.index', compact('provinces'));
    }
}
