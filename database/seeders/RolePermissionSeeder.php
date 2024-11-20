<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Define the permissions
        $permissions = [
            'gérer les utilisateurs',
            'voir statistiques',
            'voir les annonces',
            'modifier les annonces',
            'modifier les roles',
            'créer une annonce',
            'modifier une annonce',
            'supprimer une annonce',
            'voir les demandes',
            'faire une demande',
            'contacter un agent',
        ];

        // Create permissions if they don't exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'web']
            );
        }

        // Define the roles and their respective permissions
        $roles = [
            'Admin' => [
                'gérer les utilisateurs',
                'voir statistiques',
                'modifier les roles',
            ],
            'Client' => [
                'voir les annonces',
                'faire une demande',
                'contacter un agent',
            ],
            'Agent' => [
                'créer une annonce',
                'modifier une annonce',
                'supprimer une annonce',
                'voir les demandes',
            ],
        ];

        // Create the roles and assign permissions
        foreach ($roles as $roleName => $permissions) {
            // Create the role or get it if it exists
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);

            // Find all permissions first (better performance)
            $permissionInstances = Permission::whereIn('name', $permissions)->get();

            // Assign each permission to the role
            foreach ($permissionInstances as $permissionInstance) {
                // Ensure that the permission exists before assigning it
                if ($permissionInstance) {
                    $role->givePermissionTo($permissionInstance); // Assign the permission to the role
                }
            }
        }
    }
}
