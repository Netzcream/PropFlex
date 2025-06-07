<x-layouts.app :title="__('Dashboard')">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <x-dashboard.card title="Propiedades Activas" :count="$propertiesActive" icon="house" />
        <x-dashboard.card title="Contactos Recibidos (hoy)" :count="$contactsToday" icon="envelope" />
        <x-dashboard.card title="Destacadas" :count="$propertiesFeatured" icon="star" />
        <x-dashboard.card title="Usuarios" :count="$userCount" icon="users" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
            <h2 class="text-lg font-semibold mb-2">Últimos contactos recibidos</h2>
            <x-dashboard.contacts-list :contacts="$lastContacts" />
        </div>
        <div>
            <h2 class="text-lg font-semibold mb-2">Propiedades próximas a vencer</h2>
            <x-dashboard.expiring-properties :properties="$expiringProps" />
        </div>
    </div>

</x-layouts.app>
