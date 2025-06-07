<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Property;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class ToggleFavoriteButton extends Component
{
    public Property $property;
    public bool $isFavorite = false;
    public string $top = 'top-6';
    public string $right = 'right-6';

    public function mount(Property $property,  string $top = 'top-6', string $right = 'right-6')
    {
        $this->top = $top;
        $this->right = $right;
        $this->property = $property;
        $this->isFavorite = Auth::user()->favorites->contains('property_id', $property->id);
    }

    public function toggle()
    {
        $user = Auth::user();

        if ($this->isFavorite) {
            Favorite::where('user_id', $user->id)
                ->where('property_id', $this->property->id)
                ->delete();
            $this->isFavorite = false;
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'property_id' => $this->property->id,
            ]);
            $this->isFavorite = true;
        }
    }

    public function render()
    {
        return view('livewire.toggle-favorite-button');
    }
}
