<?php

namespace Tests\Feature\V1;

use Tests\TestCase;
use App\Models\User;
use App\Models\V1\IncomingRequest;
use App\Models\V1\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IncomingRequestTest extends TestCase
{
    use  RefreshDatabase;

    protected string $endpoint = '/api/v1/incomingRequests';
    protected string $tableName = 'incomingRequests';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateIncomingRequest(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $payload = IncomingRequest::factory()->make([])->toArray();

        $this->json('POST', $this->endpoint, $payload)
             ->assertStatus(201)
             ->assertSee($payload['name']);

        $this->assertDatabaseHas($this->tableName, ['id' => 1]);
    }

    public function testViewAllIncomingRequestsSuccessfully(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        IncomingRequest::factory(5)->create();

        $this->json('GET', $this->endpoint)
             ->assertStatus(200)
             ->assertJsonCount(5, 'data')
             ->assertSee(IncomingRequest::find(rand(1, 5))->name);
    }

    public function testViewAllIncomingRequestsByFooFilter(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        IncomingRequest::factory(5)->create();

        $this->json('GET', $this->endpoint.'?foo=1')
             ->assertStatus(200)
             ->assertSee('foo')
             ->assertDontSee('foo');
    }

    public function testsCreateIncomingRequestValidation(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $data = [
        ];

        $this->json('post', $this->endpoint, $data)
             ->assertStatus(422);
    }

    public function testViewIncomingRequestData(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        IncomingRequest::factory()->create();

        $this->json('GET', $this->endpoint.'/1')
             ->assertSee(IncomingRequest::first()->name)
             ->assertStatus(200);
    }

    public function testUpdateIncomingRequest(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        IncomingRequest::factory()->create();

        $payload = [
            'name' => 'Random'
        ];

        $this->json('PUT', $this->endpoint.'/1', $payload)
             ->assertStatus(200)
             ->assertSee($payload['name']);
    }

    public function testDeleteIncomingRequest(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        IncomingRequest::factory()->create();

        $this->json('DELETE', $this->endpoint.'/1')
             ->assertStatus(204);

        $this->assertEquals(0, IncomingRequest::count());
    }

    public function test_can_get_all_incoming_requests(): void
    {
        IncomingRequest::factory(3)->create();

        $response = $this->getJson('/api/v1/incoming-requests');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'project_id',
                        'type',
                        'http_method',
                        'headers',
                        'payload',
                        'status',
                        'received_at',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'links',
                'meta',
            ]);
    }

    public function test_can_create_incoming_request(): void
    {
        $project = Project::factory()->create();
        $data = [
            'project_id' => $project->id,
            'type' => 'webhook',
            'http_method' => 'POST',
            'headers' => ['Content-Type' => 'application/json'],
            'payload' => ['data' => 'test'],
            'status' => 'new',
            'received_at' => now()->toDateTimeString(),
        ];

        $response = $this->postJson('/api/v1/incoming-requests', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'project_id',
                    'type',
                    'http_method',
                    'headers',
                    'payload',
                    'status',
                    'received_at',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    public function test_can_show_incoming_request(): void
    {
        $incomingRequest = IncomingRequest::factory()->create();

        $response = $this->getJson("/api/v1/incoming-requests/{$incomingRequest->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'project_id',
                'type',
                'http_method',
                'headers',
                'payload',
                'status',
                'received_at',
                'created_at',
                'updated_at',
            ]);
    }

    public function test_can_update_incoming_request(): void
    {
        $incomingRequest = IncomingRequest::factory()->create();
        $data = [
            'status' => 'processed',
        ];

        $response = $this->putJson("/api/v1/incoming-requests/{$incomingRequest->id}", $data);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'project_id',
                    'type',
                    'http_method',
                    'headers',
                    'payload',
                    'status',
                    'received_at',
                    'created_at',
                    'updated_at',
                ],
            ]);
        $this->assertEquals('processed', $incomingRequest->fresh()->status);
    }

    public function test_can_delete_incoming_request(): void
    {
        $incomingRequest = IncomingRequest::factory()->create();

        $response = $this->deleteJson("/api/v1/incoming-requests/{$incomingRequest->id}");

        $response->assertStatus(200)
            ->assertJsonStructure(['message']);
        $this->assertDatabaseMissing('incoming_requests', ['id' => $incomingRequest->id]);
    }
}
