<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\V1\Project;
use App\Models\V1\ProjectTarget;
use App\Models\V1\IncomingRequest;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\V1\DeliveryAttemptSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Création d'un utilisateur de test
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Création de projets de test
        Project::factory(3)
            ->create([
                'user_id' => $user->id
            ])
            ->each(function ($project) {
                // Création de 2 cibles pour chaque projet
                ProjectTarget::factory(2)->create([
                    'project_id' => $project->id,
                    'active' => true
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