<?php

namespace App\Livewire\Contacts;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Contact;
use App\Models\Property;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    public string $sortBy = 'created_at';
    public string $sortDirection = 'desc';
    public string $search = '';
    public $property = '';
    public $perPage = 10;
    public string $contactToDelete = '';

    public $properties = [];

    public function mount()
    {
        // Si querés que se pueda filtrar por propiedad
        $this->properties = Property::orderBy('title')->get();
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
        $this->contactToDelete = $uuid;
    }

    public function delete(): void
    {
        $contact = Contact::where('uuid', $this->contactToDelete)->first();

        if (!$contact) {
            return;
        }

        $contact->delete();

        $this->dispatch('contact-deleted');
        $this->reset('contactToDelete');
    }
    public function updatedProperty()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Contact::query()
            ->with(['property'])
            ->when($this->search, function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('phone', 'like', "%{$this->search}%")
                    ->orWhere('message', 'like', "%{$this->search}%");
            })
            ->when($this->property, fn($q) => $q->where('property_id', $this->property));

        $contacts = $query->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.contacts.index', compact('contacts'));
    }
}
