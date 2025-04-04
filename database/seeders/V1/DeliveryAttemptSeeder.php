<?php

declare(strict_types=1);

namespace Database\Seeders\V1;

use App\Models\V1\DeliveryAttempt;
use App\Models\V1\IncomingRequest;
use App\Models\V1\ProjectTarget;
use Illuminate\Database\Seeder;

final class DeliveryAttemptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Pour chaque requête entrante
        IncomingRequest::all()->each(function ($request): void {
            // Récupérer les cibles du projet
            $targets = ProjectTarget::where('project_id', $request->project_id)
                ->where('active', true)
                ->get();

            // Pour chaque cible active
            $targets->each(function ($target) use ($request): void {
                // 40% de succès
                if (rand(1, 100) <= 40) {
                    DeliveryAttempt::factory()
                        ->success()
                        ->create([
                            'incoming_request_id' => $request->id,
                            'project_target_id' => $target->id,
                            'attempt_count' => 1,
                        ]);
                }
                // 30% d'échecs après plusieurs tentatives
                elseif (rand(1, 100) <= 70) {
                    DeliveryAttempt::factory()
                        ->failed()
                        ->create([
                            'incoming_request_id' => $request->id,
                            'project_target_id' => $target->id,
                            'attempt_count' => rand(2, 5),
                        ]);
                }
                // 30% en attente ou en cours
                else {
                    DeliveryAttempt::factory()
                        ->pending()
                        ->create([
                            'incoming_request_id' => $request->id,
                            'project_target_id' => $target->id,
                            'attempt_count' => rand(0, 2),
                        ]);
                }
            });
        });
    }
}
