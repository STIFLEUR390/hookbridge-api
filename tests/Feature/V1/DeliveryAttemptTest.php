<?php

namespace Tests\Feature\V1;

use Tests\TestCase;
use App\Models\User;
use App\Models\V1\DeliveryAttempt;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeliveryAttemptTest extends TestCase
{
    use  RefreshDatabase;

    protected string $endpoint = '/api/v1/deliveryAttempts';
    protected string $tableName = 'deliveryAttempts';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateDeliveryAttempt(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $payload = DeliveryAttempt::factory()->make([])->toArray();

        $this->json('POST', $this->endpoint, $payload)
             ->assertStatus(201)
             ->assertSee($payload['name']);

        $this->assertDatabaseHas($this->tableName, ['id' => 1]);
    }

    public function testViewAllDeliveryAttemptsSuccessfully(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        DeliveryAttempt::factory(5)->create();

        $this->json('GET', $this->endpoint)
             ->assertStatus(200)
             ->assertJsonCount(5, 'data')
             ->assertSee(DeliveryAttempt::find(rand(1, 5))->name);
    }

    public function testViewAllDeliveryAttemptsByFooFilter(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        DeliveryAttempt::factory(5)->create();

        $this->json('GET', $this->endpoint.'?foo=1')
             ->assertStatus(200)
             ->assertSee('foo')
             ->assertDontSee('foo');
    }

    public function testsCreateDeliveryAttemptValidation(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $data = [
        ];

        $this->json('post', $this->endpoint, $data)
             ->assertStatus(422);
    }

    public function testViewDeliveryAttemptData(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        DeliveryAttempt::factory()->create();

        $this->json('GET', $this->endpoint.'/1')
             ->assertSee(DeliveryAttempt::first()->name)
             ->assertStatus(200);
    }

    public function testUpdateDeliveryAttempt(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        DeliveryAttempt::factory()->create();

        $payload = [
            'name' => 'Random'
        ];

        $this->json('PUT', $this->endpoint.'/1', $payload)
             ->assertStatus(200)
             ->assertSee($payload['name']);
    }

    public function testDeleteDeliveryAttempt(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        DeliveryAttempt::factory()->create();

        $this->json('DELETE', $this->endpoint.'/1')
             ->assertStatus(204);

        $this->assertEquals(0, DeliveryAttempt::count());
    }
    
}
