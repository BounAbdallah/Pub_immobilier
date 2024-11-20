<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        // Vérifier si les rôles existent, sinon les créer
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $agentRole = Role::firstOrCreate(['name' => 'Agent']);
        $clientRole = Role::firstOrCreate(['name' => 'Client']);

        // Vérifier si les utilisateurs existent et leur attribuer les rôles
        $client = User::find(1);
        if ($client) {
            $client->assignRole($clientRole);
        }

        $agent = User::find(2);
        if ($agent) {
            $agent->assignRole($agentRole);
        }

        $admin = User::find(3);
        if ($admin) {
            $admin->assignRole($adminRole);
        }
    }
}
