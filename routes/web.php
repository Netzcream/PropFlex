<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Livewire\Dashboard\Index as DashboardIndex;
use App\Livewire\Contacts\Index as ContactIndex;
use App\Livewire\Contacts\Show as ContactShow;
use App\Livewire\ProfileForm;
use App\Livewire\Properties\Index as PropertiesIndex;
use App\Livewire\Properties\Form as PropertiesForm;
use App\Livewire\PropertyTypes\Index as PropertyTypesIndex;
use App\Livewire\PropertyTypes\Form as PropertyTypesForm;

use App\Livewire\Users\Index as UsersIndex;
use App\Livewire\Users\Form as UsersForm;


use App\Livewire\PropertyFeatures\Index as PropertyFeaturesIndex;
use App\Livewire\PropertyFeatures\Form as PropertyFeaturesForm;

use App\Livewire\Provinces\Index as ProvincesIndex;
use App\Livewire\Provinces\Form as ProvincesForm;

use App\Livewire\Cities\Index as CitiesIndex;
use App\Livewire\Cities\Form as CitiesForm;

use App\Livewire\Neighborhoods\Index as NeighborhoodsIndex;
use App\Livewire\Neighborhoods\Form as NeighborhoodsForm;

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Admin\Locations\{ProvinceForm, CityForm, NeighborhoodForm};


Route::GET('/', [HomeController::class, 'index'])
    ->name('home');



Route::middleware(['auth', 'verified', 'role:agente|admin|editor'])->group(function () {

    // Dashboard
    //Route::get('/dashboard', fn() =>  view('dashboard'))->name('dashboard');
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {



        // Propiedades
        Route::prefix('properties')->name('properties.')->group(function () {
            Route::get('/', PropertiesIndex::class)->name('index');
            Route::get('/create', PropertiesForm::class)->name('create');
            Route::get('/{property}/edit', PropertiesForm::class)->name('edit');
        })->middleware('role:agente|admin');


        Route::prefix('property-types')->name('property-types.')->group(function () {
            Route::get('/', PropertyTypesIndex::class)->name('index');
            Route::get('/create', PropertyTypesForm::class)->name('create');
            Route::get('/{property}/edit', PropertyTypesForm::class)->name('edit');
        })->middleware('role:agente|admin|editor');


        Route::prefix('property-features')->name('property-features.')->group(function () {
            Route::get('/', PropertyFeaturesIndex::class)->name('index');
            Route::get('/create', PropertyFeaturesForm::class)->name('create');
            Route::get('/{property}/edit', PropertyFeaturesForm::class)->name('edit');
        })->middleware('role:agente|admin|editor');

        Route::prefix('contacts')->name('contacts.')->group(function () {
            Route::get('/', ContactIndex::class)->name('index');

            Route::get('/{contact}', ContactShow::class)->name('show');
        })->middleware('role:agente|admin');

        // Usuarios
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', UsersIndex::class)->name('index');
            Route::get('/create', UsersForm::class)->name('create');
            Route::get('/{user}/edit', UsersForm::class)->name('edit');
        })->middleware('role:admin');


        Route::prefix('provinces')->name('provinces.')->group(function () {
            Route::get('/', ProvincesIndex::class)->name('index');
            Route::get('/create', ProvincesForm::class)->name('create');
            Route::get('/{province}/edit', ProvincesForm::class)->name('edit');
        })->middleware('role:agente|admin|editor');

        Route::prefix('cities')->name('cities.')->group(function () {
            Route::get('/', CitiesIndex::class)->name('index');
            Route::get('/create', CitiesForm::class)->name('create');
            Route::get('/{city}/edit', CitiesForm::class)->name('edit');
        })->middleware('role:agente|admin|editor');

        Route::prefix('neighborhoods')->name('neighborhoods.')->group(function () {
            Route::get('/', NeighborhoodsIndex::class)->name('index');
            Route::get('/create', NeighborhoodsForm::class)->name('create');
            Route::get('/{neighborhood}/edit', NeighborhoodsForm::class)->name('edit');
        })->middleware('role:agente|admin|editor');

        // Estadísticas
        Route::get('/reports', fn() => 'Estadísticas')->name('reports.index');
    });
});



#Provisorios
Route::resource('properties', PropertyController::class)->only(['index', 'show'])->names('properties');

Route::get('/properties/{property}/export', [\App\Http\Controllers\PropertyController::class, 'exportPdf'])->name('properties.export');

Route::get('/about', function () {
    return view('home');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact_property', function () {
    return view('home');
})->name('contact.property');




Route::middleware(['auth'])->group(function () {

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
})->middleware('role:agente|admin|editor');

require __DIR__ . '/auth.php';
