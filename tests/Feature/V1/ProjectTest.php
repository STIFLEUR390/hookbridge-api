<?php

declare(strict_types=1);

namespace Tests\Feature\V1;

use App\Models\User;
use App\Models\V1\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class ProjectTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();

        // Créer un token Sanctum pour l'utilisateur
        $token = $this->user->createToken('test-token')->plainTextToken;
        $this->withHeader('Authorization', 'Bearer ' . $token);
    }

    public function test_can_list_projects(): void
    {
        Project::factory()->count(3)->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->getJson('/api/v1/projects');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'allowed_domain',
                        'allowed_subdomain',
                        'header',
                        'provider_config',
                        'uuid',
                        'active',
                        'created_at',
                        'updated_at',
                        'status',
                        'domain_url',
                    ],
                ],
            ]);
    }

    public function test_can_create_project(): void
    {
        $data = [
            'name' => 'Mon Projet',
            'allowed_domain' => 'example.com',
            'allowed_subdomain' => 'https://api.example.com',
            'header' => 'X-API-Key',
            'provider_config' => ['key' => 'value'],
            'active' => true,
        ];

        $response = $this->actingAs($this->user)
            ->postJson('/api/v1/projects', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'allowed_domain',
                    'allowed_subdomain',
                    'header',
                    'provider_config',
                    'uuid',
                    'active',
                    'created_at',
                    'updated_at',
                    'status',
                    'domain_url',
                ],
            ]);

        $this->assertDatabaseHas('projects', [
            'name' => $data['name'],
            'allowed_domain' => $data['allowed_domain'],
            'allowed_subdomain' => $data['allowed_subdomain'],
            'header' => $data['header'],
            'active' => $data['active'],
        ]);
    }

    public function test_can_show_project(): void
    {
        $project = Project::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->getJson("/api/v1/projects/{$project->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'allowed_domain',
                    'allowed_subdomain',
                    'header',
                    'provider_config',
                    'uuid',
                    'active',
                    'created_at',
                    'updated_at',
                    'status',
                    'domain_url',
                ],
            ]);
    }

    public function test_can_update_project(): void
    {
        $project = Project::factory()->create(['user_id' => $this->user->id]);
        $data = [
            'name' => 'Projet Mis à Jour',
            'allowed_domain' => 'updated.com',
            'allowed_subdomain' => 'https://api.updated.com',
            'header' => 'X-Updated-Key',
            'provider_config' => ['key' => 'updated'],
            'active' => false,
        ];

        $response = $this->actingAs($this->user)
            ->putJson("/api/v1/projects/{$project->id}", $data);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'allowed_domain',
                    'allowed_subdomain',
                    'header',
                    'provider_config',
                    'uuid',
                    'active',
                    'created_at',
                    'updated_at',
                    'status',
                    'domain_url',
                ],
            ]);

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'name' => $data['name'],
            'allowed_domain' => $data['allowed_domain'],
            'allowed_subdomain' => $data['allowed_subdomain'],
            'header' => $data['header'],
            'active' => $data['active'],
        ]);
    }

    public function test_can_delete_project(): void
    {
        $project = Project::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->deleteJson("/api/v1/projects/{$project->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_can_toggle_project_status(): void
    {
        $project = Project::factory()->create([
            'user_id' => $this->user->id,
            'active' => true,
        ]);

        $response = $this->actingAs($this->user)
            ->patchJson("/api/v1/projects/{$project->id}/toggle-status");

        $response->assertStatus(200);
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'active' => false,
        ]);

        $response = $this->actingAs($this->user)
            ->patchJson("/api/v1/projects/{$project->id}/toggle-status");

        $response->assertStatus(200);
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'active' => true,
        ]);
    }

    public function test_cannot_access_projects_without_authentication(): void
    {
        $response = $this->getJson('/api/v1/projects');
        $response->assertStatus(401);
    }

    public function test_cannot_access_other_users_projects(): void
    {
        $otherUser = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->actingAs($this->user)
            ->getJson("/api/v1/projects/{$project->id}");

        $response->assertStatus(403);
    }

    public function test_validation_errors_on_create(): void
    {
        $data = [
            'name' => '', // Nom vide
            'allowed_domain' => 'invalid-domain', // Domaine invalide
            'allowed_subdomain' => 'not-a-url', // URL invalide
        ];

        $response = $this->actingAs($this->user)
            ->postJson('/api/v1/projects', $data);

        $response->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['The name field is required.'],
                    'allowed_domain' => ['Le domaine doit être valide (exemple: example.com)'],
                    'allowed_subdomain' => ['Le sous-domaine doit être une URL valide'],
                ],
            ]);
    }
}
