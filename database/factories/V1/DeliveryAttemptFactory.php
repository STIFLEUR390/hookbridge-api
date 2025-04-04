<?php

declare(strict_types=1);

namespace Database\Factories\V1;

use App\Models\V1\DeliveryAttempt;
use App\Models\V1\IncomingRequest;
use App\Models\V1\ProjectTarget;
use Illuminate\Database\Eloquent\Factories\Factory;

final class DeliveryAttemptFactory extends Factory
{
    protected $model = DeliveryAttempt::class;

    public function definition(): array
    {
        return [
            'incoming_request_id' => IncomingRequest::factory(),
            'project_target_id' => ProjectTarget::factory(),
            'attempt_count' => $this->faker->numberBetween(0, 5),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'success', 'failed']),
            'response_code' => $this->faker->randomElement([200, 201, 400, 401, 403, 404, 500, 502, 503]),
            'response_body' => $this->faker->randomElement([
                json_encode(['status' => 'success', 'message' => 'Webhook received']),
                json_encode(['error' => 'Invalid signature']),
                json_encode(['error' => 'Rate limit exceeded']),
                json_encode(['status' => 'error', 'message' => 'Internal server error']),
            ]),
            'next_attempt_at' => $this->faker->optional(0.7)->dateTimeBetween('now', '+1 day'),
            'last_attempt_at' => $this->faker->dateTimeBetween('-1 day', 'now'),
        ];
    }

    /**
     * Indicate that the delivery attempt is pending.
     */
    public function pending(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'pending',
            'response_code' => null,
            'response_body' => null,
            'next_attempt_at' => now()->addMinutes(5),
        ]);
    }

    /**
     * Indicate that the delivery attempt is in progress.
     */
    public function inProgress(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'in_progress',
            'next_attempt_at' => null,
        ]);
    }

    /**
     * Indicate that the delivery attempt was successful.
     */
    public function success(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'success',
            'response_code' => 200,
            'response_body' => json_encode(['status' => 'success', 'message' => 'Webhook received']),
            'next_attempt_at' => null,
        ]);
    }

    /**
     * Indicate that the delivery attempt has failed.
     */
    public function failed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'failed',
            'response_code' => $this->faker->randomElement([400, 401, 403, 404, 500, 502, 503]),
            'response_body' => json_encode(['error' => $this->faker->sentence()]),
            'next_attempt_at' => $this->faker->optional(0.3)->dateTimeBetween('now', '+1 hour'),
        ]);
    }
}
