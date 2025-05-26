<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';
    public $success = false;

    protected $rules = [
        'name'  => 'required|string|max:100',
        'email' => 'required|email|max:150',
        'message' => 'required|string|min:8|max:1000',
    ];

    public function mount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->name = $user->name ?? '';
            $this->email = $user->email ?? '';
        }
    }

    public function send()
    {
        $this->validate();

        Contact::create([
            'user_id' => Auth::id(),
            'name'    => $this->name,
            'email'   => $this->email,
            'message' => $this->message,
        ]);

        $this->reset(['name', 'email', 'message']);
        $this->success = true;

        // Acá podrías enviar mail si querés:
        // Mail::to(config('mail.from.address'))->send(new ContactMessage(...));
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
