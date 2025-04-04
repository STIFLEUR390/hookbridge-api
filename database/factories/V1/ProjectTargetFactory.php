<?php

declare(strict_types=1);

namespace Database\Factories\V1;

use App\Models\V1\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ProjectTargetFactory extends Factory
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
