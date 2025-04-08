<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

final class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Réinitialiser les rôles et permissions en cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Créer les permissions pour les projets
        $projectPermissions = [
            'view projects',
            'create projects',
            'edit projects',
            'delete projects',
            'view project targets',
            'create project targets',
            'edit project targets',
            'delete project targets',
            'view incoming requests',
            'view delivery attempts',
        ];

        // Créer les permissions pour l'administration
        $adminPermissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'view all projects',
            'edit all projects',
            'delete all projects',
            'view all project targets',
            'edit all project targets',
            'delete all project targets',
            'view all incoming requests',
            'view all delivery attempts',
        ];

        // Créer toutes les permissions
        foreach ([...$projectPermissions, ...$adminPermissions] as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Créer le rôle utilisateur et lui attribuer les permissions de base
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($projectPermissions);

        // Créer le rôle admin et lui attribuer toutes les permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([...$projectPermissions, ...$adminPermissions]);
    }
}
