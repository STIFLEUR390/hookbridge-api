<?php

namespace Database\Factories\V1;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'allowed_domain' => $this->faker->domainName(),
            'allowed_subdomain' => 'https://' . $this->faker->domainWord() . '.example.com',
            'header' => 'X-API-Key',
            'provider_config' => json_encode(['key' => $this->faker->password()]),
            'uuid' => $this->faker->uuid(),
            'active' => true,
            'user_id' => User::factory(),
        ];
    }
}