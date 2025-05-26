<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;

class ContactPropertyForm extends Component
{
    public $property;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $message = '';
    public $success = false;


    public function mount($property)
    {
        $this->property = $property;
        $this->message = "Hola! estoy interesado en la propiedad {$property->title}; me gustaría que se comuniquen conmigo.";

        if (Auth::check()) {
            $user = Auth::user();
            $this->name = $user->name ?? '';
            $this->email = $user->email ?? '';
            // Asumiendo que tu User tiene campo phone:
            $this->phone = $user->phone ?? '';
        }
    }




    protected function rules()
    {
        return [
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'phone'   => 'nullable|string|max:30',
            'message' => 'required|string|max:1000',
        ];
    }

    public function send()
    {
        $this->validate();

        Contact::create([
            'user_id'     => Auth::id(),
            'property_id' => $this->property->id,
            'name'        => $this->name,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'message'     => $this->message,
        ]);

        $this->reset(['name', 'email', 'phone']);
        $this->success = true;


        // Acá podrías enviar un mail, guardar en la DB, etc.
        // Mail::to(config('mail.from.address'))->send(new ...);

        $this->reset(['name', 'email', 'phone']);
        $this->success = true;
    }

    public function render()
    {
        return view('livewire.contact-property-form');
    }
}
