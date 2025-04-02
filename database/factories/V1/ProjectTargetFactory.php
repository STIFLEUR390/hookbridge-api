<?php

namespace Database\Factories\V1;

use App\Models\V1\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectTargetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'url' => $this->faker->url(),
            'requires_authentication' => $this->faker->boolean(),
            'secret' => $this->faker->password(),
            'active' => $this->faker->boolean(),
        ];
    }
}