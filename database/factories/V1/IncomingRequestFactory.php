<?php

namespace Database\Factories\V1;

use App\Models\V1\IncomingRequest;
use App\Models\V1\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomingRequestFactory extends Factory
{
    protected $model = IncomingRequest::class;

    public function definition(): array
    {
        $eventTypes = [
            'user.created',
            'user.updated',
            'order.created',
            'order.paid',
            'subscription.renewed'
        ];

        return [
            'project_id' => Project::factory(),
            'type' => $this->faker->randomElement(['webhook', 'callback']),
            'http_method' => $this->faker->randomElement(['GET', 'POST']),
            'headers' => [
                'Content-Type' => 'application/json',
                'User-Agent' => $this->faker->userAgent(),
                'X-Request-ID' => $this->faker->uuid(),
                'X-Signature' => $this->faker->sha256,
            ],
            'payload' => [
                'event' => $this->faker->randomElement($eventTypes),
                'timestamp' => $this->faker->unixTime(),
                'data' => [
                    'id' => $this->faker->numberBetween(1, 1000),
                    'name' => $this->faker->name(),
                    'email' => $this->faker->email(),
                ],
            ],
            'status' => $this->faker->randomElement(['new', 'processing', 'processed', 'failed']),
            'received_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }

    /**
     * Indicate that the request is new.
     */
    public function setNew(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'new',
        ]);
    }

    /**
     * Indicate that the request is processed.
     */
    public function processed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'processed',
        ]);
    }

    /**
     * Indicate that the request has failed.
     */
    public function failed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'failed',
        ]);
    }
}