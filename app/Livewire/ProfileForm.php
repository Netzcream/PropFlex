<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileForm extends Component
{
    use WithFileUploads;

    public $name = '';
    public $email = '';
    public $phone = '';
    public $avatar;
    public $avatarPreview;
    public $password = '';
    public $password_confirmation = '';

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
        // Set avatar preview si existe
        $media = $user->getFirstMedia('avatar');
        $this->avatarPreview = $media ? $media->getUrl('thumb') : null;
    }

    public function updatedAvatar()
    {
        if ($this->avatar) {
            $this->avatarPreview = $this->avatar->temporaryUrl();
        }
    }

    public function save()
    {
        /** @var User $user */
        $user = Auth::user();

        $rules = [
            'name'  => 'required|string|max:255',
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|max:2048', // 2MB
        ];

        if ($this->password) {
            $rules['password'] = 'required|min:8|confirmed';
        }

        $validated = $this->validate($rules);

        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        // Si subió avatar, guardarlo con Spatie MediaLibrary
        if ($this->avatar) {
            $user->clearMediaCollection('avatar');
            $user->addMedia($this->avatar->getRealPath())
                ->preservingOriginal()
                ->toMediaCollection('avatar');
        }

        session()->flash('success', 'Perfil actualizado correctamente.');
        $this->reset('password', 'password_confirmation', 'avatar');
        // Refrescar avatarPreview si corresponde
        $media = $user->getFirstMedia('avatar');
        $this->avatarPreview = $media ? $media->getUrl('thumb') : null;
    }

    public function render()
    {
        return view('livewire.profile-form');
    }
}
