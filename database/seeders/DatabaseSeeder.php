<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use App\Models\V1\IncomingRequest;
use App\Models\V1\Project;
use App\Models\V1\ProjectTarget;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\V1\DeliveryAttemptSeeder;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RoleAndPermissionSeeder::class,
            AdminUserSeeder::class,
        ]);

        // Création d'un utilisateur de test
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('user');

        $user2 = User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user2->assignRole('user');

        // Création de projets de test
        Project::factory(3)
            ->create([
                'user_id' => $user->id,
            ])
            ->each(function ($project): void {
                // Création de 2 cibles pour chaque projet
                ProjectTarget::factory(2)->create([
                    'project_id' => $project->id,
                    'active' => true,
                ]);

                // Création de requêtes entrantes pour chaque projet
                // 5 nouvelles requêtes
                IncomingRequest::factory(5)
                    ->setNew()
                    ->create([
                        'project_id' => $project->id,
                    ]);

                // 3 requêtes traitées
                IncomingRequest::factory(3)
                    ->processed()
                    ->create([
                        'project_id' => $project->id,
                    ]);

                // 2 requêtes en erreur
                IncomingRequest::factory(2)
                    ->failed()
                    ->create([
                        'project_id' => $project->id,
                    ]);
            });

        // Création des tentatives de livraison
        $this->call(DeliveryAttemptSeeder::class);
    }
}