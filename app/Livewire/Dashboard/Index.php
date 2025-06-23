<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Property;
use App\Models\Contact;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public $propertiesActive;
    public $propertiesFeatured;
    public $propertiesDrafts;
    public $contactsToday;
    public $contactsMonth;
    public $userCount;
    public $lastContacts;
    public $expiringProps;
    public $topVisited;
    public $topFavorited;

    public function mount()
    {
        $this->propertiesActive = Property::where('is_published', true)->count();
        $this->propertiesFeatured = Property::where('is_featured', true)->count();
        $this->propertiesDrafts = Property::where('is_published', false)->count();
        $this->contactsToday = Contact::whereDate('created_at', Carbon::today())->count();
        $this->contactsMonth = Contact::whereMonth('created_at', Carbon::now()->month)->count();

        $this->topVisited = Property::withCount('visits')
            ->orderByDesc('visits_count')
            ->take(5)
            ->get();

        $this->topFavorited = Property::withCount('favorites')
            ->orderByDesc('favorites_count')
            ->take(5)
            ->get();


        $this->userCount = User::count();

        $this->lastContacts = Contact::latest()->take(5)->with('property')->get();
        $this->expiringProps = Property::where('is_published', true)
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', Carbon::now()->addDays(10))
            ->orderBy('expires_at')->take(5)->get();
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
