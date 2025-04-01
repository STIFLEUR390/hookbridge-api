<?php

namespace Database\Factories\V1;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
			'allowed_domain' => $this->faker->domainName(),
			'allowed_subdomain' => $this->faker->domainWord(),
			'header' => $this->faker->boolean() ? 'verif-hash' : null,
			'provider_config' => $this->faker->boolean() ? $this->faker->text() : null,
			'uuid' => $this->faker->uuid(),
			'active' => $this->faker->boolean(),
			'user_id' => createOrRandomFactory(\App\Models\User::class),
        ];
    }
}