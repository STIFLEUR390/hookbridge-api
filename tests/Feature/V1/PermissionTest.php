<?php

declare(strict_types=1);

namespace Tests\Feature\V1;

use App\Models\User;
use App\Models\V1\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class PermissionTest extends TestCase
{
    use  RefreshDatabase;

    protected string $endpoint = '/api/v1/permissions';
    protected string $tableName = 'permissions';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreatePermission(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $payload = Permission::factory()->make([])->toArray();

        $this->json('POST', $this->endpoint, $payload)
            ->assertStatus(201)
            ->assertSee($payload['name']);

        $this->assertDatabaseHas($this->tableName, ['id' => 1]);
    }

    public function testViewAllPermissionsSuccessfully(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        Permission::factory(5)->create();

        $this->json('GET', $this->endpoint)
            ->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertSee(Permission::find(rand(1, 5))->name);
    }

    public function testViewAllPermissionsByFooFilter(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        Permission::factory(5)->create();

        $this->json('GET', $this->endpoint . '?foo=1')
            ->assertStatus(200)
            ->assertSee('foo')
            ->assertDontSee('foo');
    }

    public function testsCreatePermissionValidation(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $data = [
        ];

        $this->json('post', $this->endpoint, $data)
            ->assertStatus(422);
    }

    public function testViewPermissionData(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        Permission::factory()->create();

        $this->json('GET', $this->endpoint . '/1')
            ->assertSee(Permission::first()->name)
            ->assertStatus(200);
    }

    public function testUpdatePermission(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        Permission::factory()->create();

        $payload = [
            'name' => 'Random',
        ];

        $this->json('PUT', $this->endpoint . '/1', $payload)
            ->assertStatus(200)
            ->assertSee($payload['name']);
    }

    public function testDeletePermission(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        Permission::factory()->create();

        $this->json('DELETE', $this->endpoint . '/1')
            ->assertStatus(204);

        $this->assertEquals(0, Permission::count());
    }

}
