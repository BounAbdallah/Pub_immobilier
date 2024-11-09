<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            // Permissions générales
            'gérer les utilisateurs',
            'creer une livraison',

        ];

        // Créer toutes les permissions si elles n'existent pas déjà
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->where('guard_name', 'web')->exists()) {
                Permission::create(['name' => $permission, 'guard_name' => 'web']);
            }
        }

        $roles = [
            'Admin' => [
                'gérer les utilisateurs',

            ],





            'Client' => [



            ],

            'Agent' => [



            ],

        ];

        // Créer les rôles et leur attribuer les permissions
        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            foreach ($permissions as $permission) {
                $permissionInstance = Permission::where('name', $permission)->where('guard_name', 'web')->first();
                if ($permissionInstance) {
                    $role->givePermissionTo($permissionInstance);
                }
            }
        }
    }
}
