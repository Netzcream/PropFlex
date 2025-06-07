<?php

namespace App\Livewire\Contacts;

use Livewire\Component;
use App\Models\Contact;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Show extends Component
{
    public Contact $contact;

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function render()
    {
        return view('livewire.contacts.show');
    }
}
