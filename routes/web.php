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

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;



Route::GET('/', [HomeController::class, 'index'])
    ->name('home');



Route::middleware(['auth', 'verified', 'role:agente|admin'])->group(function () {

    // Dashboard
    //Route::get('/dashboard', fn() =>  view('dashboard'))->name('dashboard');
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {



        // Propiedades
        Route::prefix('properties')->name('properties.')->group(function () {
            Route::get('/', PropertiesIndex::class)->name('index');
            Route::get('/create', PropertiesForm::class)->name('create');
            Route::get('/{property}/edit', PropertiesForm::class)->name('edit');
        });


        Route::prefix('property-types')->name('property-types.')->group(function () {
            Route::get('/', PropertyTypesIndex::class)->name('index');
            Route::get('/create', PropertyTypesForm::class)->name('create');
            Route::get('/{property}/edit', PropertyTypesForm::class)->name('edit');
        });


        Route::prefix('property-features')->name('property-features.')->group(function () {
            Route::get('/', PropertyFeaturesIndex::class)->name('index');
            Route::get('/create', PropertyFeaturesForm::class)->name('create');
            Route::get('/{property}/edit', PropertyFeaturesForm::class)->name('edit');
        });

        Route::prefix('contacts')->name('contacts.')->group(function () {
            Route::get('/', ContactIndex::class)->name('index');

            Route::get('/{contact}', ContactShow::class)->name('show');
        });

        // Usuarios
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', UsersIndex::class)->name('index');
            Route::get('/create', UsersForm::class)->name('create');
            Route::get('/{user}/edit', UsersForm::class)->name('edit');
        })->middleware('role:admin');

        // Provincias, ciudades, barrios (Ubicaciones)
        Route::prefix('locations')->name('locations.')->group(function () {
            Route::get('/', fn() => 'Listado de Ubicaciones')->name('index');
            Route::get('/provinces', fn() => 'Listado de Provincias')->name('provinces');
            Route::get('/cities', fn() => 'Listado de Ciudades')->name('cities');
            Route::get('/neighborhoods', fn() => 'Listado de Barrios')->name('neighborhoods');
        })->middleware('role:admin');

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
})->middleware('role:agente|admin');

require __DIR__ . '/auth.php';
