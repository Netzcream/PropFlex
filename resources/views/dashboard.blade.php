<x-layouts.app :title="__('Dashboard')">
<div class="max-w-6xl mx-auto mt-10 px-2">
    {{-- Cards de resumen --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-neutral-900 rounded-xl p-6 flex flex-col items-start shadow relative">
            <span class="text-xs font-semibold text-gray-500 dark:text-neutral-400 uppercase mb-1">Propiedades activas</span>
            <span class="text-3xl font-bold text-blue-700 dark:text-blue-400">{{ $propertiesActive }}</span>
            <i class="fa-solid fa-house text-2xl absolute top-5 right-5 text-blue-100 dark:text-blue-900/40"></i>
            <a href="{{ route('dashboard.properties.index') }}" class="mt-3 text-sm text-blue-700 hover:underline">Ver listado</a>
        </div>
        <div class="bg-white dark:bg-neutral-900 rounded-xl p-6 flex flex-col items-start shadow relative">
            <span class="text-xs font-semibold text-gray-500 dark:text-neutral-400 uppercase mb-1">Destacadas</span>
            <span class="text-3xl font-bold text-yellow-500">{{ $propertiesFeatured }}</span>
            <i class="fa-solid fa-star text-2xl absolute top-5 right-5 text-yellow-200 dark:text-yellow-900/40"></i>
            <a href="{{ route('dashboard.properties.index', ['is_featured' => 1]) }}" class="mt-3 text-sm text-blue-700 hover:underline">Ver destacadas</a>
        </div>
        <div class="bg-white dark:bg-neutral-900 rounded-xl p-6 flex flex-col items-start shadow relative">
            <span class="text-xs font-semibold text-gray-500 dark:text-neutral-400 uppercase mb-1">Borradores</span>
            <span class="text-3xl font-bold text-gray-600 dark:text-neutral-300">{{ $propertiesDrafts }}</span>
            <i class="fa-solid fa-pen-to-square text-2xl absolute top-5 right-5 text-gray-200 dark:text-neutral-700/40"></i>
            <a href="{{ route('dashboard.properties.index', ['is_published' => 0]) }}" class="mt-3 text-sm text-blue-700 hover:underline">Ver borradores</a>
        </div>
        <div class="bg-white dark:bg-neutral-900 rounded-xl p-6 flex flex-col items-start shadow relative">
            <span class="text-xs font-semibold text-gray-500 dark:text-neutral-400 uppercase mb-1">Usuarios</span>
            <span class="text-3xl font-bold text-teal-600 dark:text-teal-400">{{ $userCount }}</span>
            <i class="fa-solid fa-users text-2xl absolute top-5 right-5 text-teal-200 dark:text-teal-900/40"></i>
            <a href="{{ route('dashboard.users.index') }}" class="mt-3 text-sm text-blue-700 hover:underline">Ver usuarios</a>
        </div>
    </div>

    {{-- Estadísticas rápidas --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white dark:bg-neutral-900 rounded-xl p-6 shadow">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-semibold text-gray-500 dark:text-neutral-400">Contactos recibidos hoy</span>
                <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $contactsToday }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm font-semibold text-gray-500 dark:text-neutral-400">Este mes</span>
                <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $contactsMonth }}</span>
            </div>
            <a href="{{ route('dashboard.contacts.index') }}" class="mt-3 inline-block text-sm text-blue-700 hover:underline">Ver contactos</a>
        </div>

        <div class="bg-white dark:bg-neutral-900 rounded-xl p-6 shadow">
            <span class="text-sm font-semibold text-gray-500 dark:text-neutral-400">Próximos a vencer</span>
            <ul class="mt-2">
                @forelse ($expiringProps as $prop)
                    <li class="flex justify-between items-center py-1">
                        <span>
                            <a href="{{ route('dashboard.properties.edit', $prop->uuid) }}" class="text-blue-700 hover:underline">{{ $prop->title }}</a>
                        </span>
                        <span class="text-xs text-gray-400 dark:text-neutral-500">
                            {{ $prop->expires_at ? $prop->expires_at->format('d/m/Y') : '-' }}
                        </span>
                    </li>
                @empty
                    <li class="text-gray-400 text-xs">No hay propiedades próximas a vencer.</li>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- Listados rápidos --}}
    <div class="bg-white dark:bg-neutral-900 rounded-xl p-6 shadow mb-8">
        <span class="text-lg font-semibold text-gray-700 dark:text-neutral-200 mb-3 block">Últimos contactos recibidos</span>
        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-neutral-400">Nombre</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-neutral-400">Email</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-neutral-400">Propiedad</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-neutral-400">Fecha</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lastContacts as $contact)
                    <tr class="hover:bg-blue-50 dark:hover:bg-blue-900/30">
                        <td class="px-4 py-2">{{ $contact->name }}</td>
                        <td class="px-4 py-2">{{ $contact->email }}</td>
                        <td class="px-4 py-2">
                            @if($contact->property)
                                <a href="{{ route('properties.show', $contact->property->slug) }}" class="text-blue-700 hover:underline" target="_blank">
                                    {{ $contact->property->title }}
                                </a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-xs text-gray-500 dark:text-neutral-400">
                            {{ $contact->created_at ? $contact->created_at->format('d/m/Y H:i') : '-' }}
                        </td>
                        <td class="px-4 py-2 text-right">
                            <a href="{{ route('dashboard.contacts.show', $contact->uuid) }}" class="text-blue-600 hover:underline">Ver</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-gray-400">No hay contactos recientes.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Enlaces rápidos --}}
    <div class="flex flex-wrap gap-3 mb-10">
        <a href="{{ route('dashboard.properties.create') }}" class="flux:button" icon="plus">
            <i class="fa-solid fa-plus mr-2"></i> Nueva propiedad
        </a>
        <a href="{{ route('dashboard.property-features.create') }}" class="flux:button" icon="plus">
            <i class="fa-solid fa-plus mr-2"></i> Nueva característica
        </a>
        <a href="{{ route('dashboard.contacts.index') }}" class="flux:button">
            <i class="fa-solid fa-envelope mr-2"></i> Ver contactos
        </a>
    </div>
</div>


</x-layouts.app>
