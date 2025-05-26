<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Definir permisos
        $permissions = [
            'ver propiedades',
            'crear propiedades',
            'editar propiedades',
            'eliminar propiedades',
            'gestionar usuarios',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Definir roles y sus permisos
        $roles = [
            'admin' => [
                'ver propiedades',
                'crear propiedades',
                'editar propiedades',
                'eliminar propiedades',
                'gestionar usuarios',
            ],
            'agente' => [
                'ver propiedades',
                'crear propiedades',
                'editar propiedades',
            ],
            'visitante' => [
                'ver propiedades',
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }


        $admin = User::firstOrCreate(
            ['email' => 'admin@propflex.netzcream.com.ar'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('flexpropZYXW'),
            ]
        );
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        $agente = User::firstOrCreate(
            ['email' => 'agente@propflex.netzcream.com.ar'],
            [
                'name' => 'Agente',
                'password' => Hash::make('flexpropZYXW'),
            ]
        );

        if (!$agente->hasRole('agente')) {
            $agente->assignRole('agente');
        }

        $user = User::firstOrCreate(
            ['email' => 'user@propflex.netzcream.com.ar'],
            [
                'name' => 'Usuario',
                'password' => Hash::make('flexpropZYXW'),
            ]
        );
        if (!$user->hasRole('visitante')) {
            $user->assignRole('visitante');
        }
    }
}
