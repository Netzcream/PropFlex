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
            'gestionar propiedades',
            'gestionar usuarios',
            'gestionar recursos',
            'gestionar contactos',
            'gestionar favoritos'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Definir roles y sus permisos
        $roles = [
            'admin' => [
                'gestionar propiedades',
                'gestionar usuarios',
                'gestionar recursos',
                'gestionar contactos',
                'gestionar favoritos'
            ],
            'agente' => [
                'gestionar propiedades',
                'gestionar recursos',
                'gestionar contactos',
                'gestionar favoritos'
            ],
            'editor' => [
                'gestionar recursos',
                'gestionar favoritos'
            ],

            'visitante' => [
                'gestionar favoritos'
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }


        $admin = User::firstOrCreate(
            ['email' => 'admin@propflex.netzcream.com.ar'],
            [
                'name' => 'Ricardo Admin',
                'password' => Hash::make('flexpropZYXW'),
            ]
        );
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        $agente = User::firstOrCreate(
            ['email' => 'agente@propflex.netzcream.com.ar'],
            [
                'name' => 'Roberto Gomez Agente',
                'password' => Hash::make('flexpropZYXW'),
            ]
        );

        if (!$agente->hasRole('agente')) {
            $agente->assignRole('agente');
        }

        $agente = User::firstOrCreate(
            ['email' => 'editor@propflex.netzcream.com.ar'],
            [
                'name' => 'Juan Carlos Editor',
                'password' => Hash::make('flexpropZYXW'),
            ]
        );

        if (!$agente->hasRole('editor')) {
            $agente->assignRole('editor');
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
