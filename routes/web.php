<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Livewire\Properties\Index as PropertiesIndex;
use App\Livewire\Properties\Form as PropertiesForm;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;



Route::GET('/', [HomeController::class, 'index'])
    ->name('home');



Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', fn() =>  view('dashboard'))->name('dashboard');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {


        // Propiedades
        Route::prefix('properties')->name('properties.')->group(function () {
            Route::get('/', PropertiesIndex::class)->name('index');
            Route::get('/create', PropertiesForm::class)->name('create');
            Route::get('/{property}/edit', PropertiesForm::class)->name('edit');
        });

        // Contactos
        Route::prefix('contacts')->name('contacts.')->group(function () {
            Route::get('/', fn() => 'Listado de Contactos')->name('index');
        });

        // Usuarios
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', fn() => 'Listado de Usuarios')->name('index');
            Route::get('/create', fn() => 'Crear Usuario')->name('create');
            Route::get('/{user}/edit', fn() => 'Editar Usuario')->name('edit');
        });

        // Features (características)
        Route::prefix('features')->name('features.')->group(function () {
            Route::get('/', fn() => 'Listado de Características')->name('index');
            Route::get('/create', fn() => 'Crear Característica')->name('create');
            Route::get('/{feature}/edit', fn() => 'Editar Característica')->name('edit');
        });

        // Types (tipos de propiedad)
        Route::prefix('types')->name('types.')->group(function () {
            Route::get('/', fn() => 'Listado de Tipos')->name('index');
            Route::get('/create', fn() => 'Crear Tipo')->name('create');
            Route::get('/{type}/edit', fn() => 'Editar Tipo')->name('edit');
        });

        // Provincias, ciudades, barrios (Ubicaciones)
        Route::prefix('locations')->name('locations.')->group(function () {
            Route::get('/', fn() => 'Listado de Ubicaciones')->name('index');
            Route::get('/provinces', fn() => 'Listado de Provincias')->name('provinces');
            Route::get('/cities', fn() => 'Listado de Ciudades')->name('cities');
            Route::get('/neighborhoods', fn() => 'Listado de Barrios')->name('neighborhoods');
        });

        // Estadísticas
        Route::get('/reports', fn() => 'Estadísticas')->name('reports.index');

        // Medios
        Route::get('/media', fn() => 'Gestión de Medios')->name('media.index');
    });
});



#Provisorios
Route::resource('properties', PropertyController::class)->only(['index', 'show'])->names('properties');

Route::get('/about', function () {
    return view('home');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/contact_property', function () {
    return view('home');
})->name('contact.property');
Route::get('/profile', function () {
    return view('home');
})->name('profile');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
