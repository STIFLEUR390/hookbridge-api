<?php

declare(strict_types=1);

namespace Tests\Feature\V1;

use App\Models\User;
use App\Models\V1\Project;
use App\Models\V1\ProjectTarget;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

final class ProjectTargetTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Project $project;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->project = Project::factory()->create(['user_id' => $this->user->id]);

        // Créer un token Sanctum pour l'utilisateur
        $token = $this->user->createToken('test-token')->plainTextToken;
        $this->withHeader('Authorization', 'Bearer ' . $token);
    }

    public function test_can_list_project_targets(): void
    {
        ProjectTarget::factory()->count(3)->create(['project_id' => $this->project->id]);

        $response = $this->getJson('/api/v1/project-targets');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'project_id',
                        'url',
                        'requires_authentication',
                        'active',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }

    public function test_can_create_project_target(): void
    {
        $data = [
            'project_id' => $this->project->id,
            'url' => 'https://example.com/webhook',
            'requires_authentication' => true,
            'secret' => 'secret-key',
            'active' => true,
        ];

        $response = $this->postJson('/api/v1/project-targets', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'project_id',
                    'url',
                    'requires_authentication',
                    'active',
                    'created_at',
                    'updated_at',
                ],
            ]);

        $this->assertDatabaseHas('project_targets', [
            'project_id' => $data['project_id'],
            'url' => $data['url'],
            'requires_authentication' => $data['requires_authentication'],
            'active' => $data['active'],
        ]);
    }

    public function test_can_show_project_target(): void
    {
        $projectTarget = ProjectTarget::factory()->create(['project_id' => $this->project->id]);

        $response = $this->getJson("/api/v1/project-targets/{$projectTarget->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'project_id',
                    'url',
                    'requires_authentication',
                    'active',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    public function test_can_update_project_target(): void
    {
        $projectTarget = ProjectTarget::factory()->create(['project_id' => $this->project->id]);
        $data = [
            'url' => 'https://updated.com/webhook',
            'requires_authentication' => false,
            'secret' => 'new-secret',
            'active' => false,
        ];

        $response = $this->putJson("/api/v1/project-targets/{$projectTarget->id}", $data);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'project_id',
                    'url',
                    'requires_authentication',
                    'active',
                    'created_at',
                    'updated_at',
                ],
            ]);

        $this->assertDatabaseHas('project_targets', [
            'id' => $projectTarget->id,
            'url' => $data['url'],
            'requires_authentication' => $data['requires_authentication'],
            'active' => $data['active'],
        ]);
    }

    public function test_can_delete_project_target(): void
    {
        $projectTarget = ProjectTarget::factory()->create(['project_id' => $this->project->id]);

        $response = $this->deleteJson("/api/v1/project-targets/{$projectTarget->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('project_targets', ['id' => $projectTarget->id]);
    }

    public function test_can_toggle_project_target_status(): void
    {
        $projectTarget = ProjectTarget::factory()->create([
            'project_id' => $this->project->id,
            'active' => true,
        ]);

        $response = $this->patchJson("/api/v1/project-targets/{$projectTarget->id}/toggle-status");

        $response->assertStatus(200);
        $this->assertDatabaseHas('project_targets', [
            'id' => $projectTarget->id,
            'active' => false,
        ]);

        $response = $this->patchJson("/api/v1/project-targets/{$projectTarget->id}/toggle-status");

        $response->assertStatus(200);
        $this->assertDatabaseHas('project_targets', [
            'id' => $projectTarget->id,
            'active' => true,
        ]);
    }

    public function test_cannot_access_project_targets_without_authentication(): void
    {
        // Supprimer le token Sanctum actuel
        $this->user->tokens()->delete();

        $response = $this->getJson('/api/v1/project-targets');
        $response->assertStatus(401);
    }

    public function test_cannot_access_other_users_project_targets(): void
    {
        $otherUser = User::factory()->create();
        $otherProject = Project::factory()->create(['user_id' => $otherUser->id]);
        $projectTarget = ProjectTarget::factory()->create(['project_id' => $otherProject->id]);

        $response = $this->getJson("/api/v1/project-targets/{$projectTarget->id}");
        $response->assertStatus(403);
    }
}
