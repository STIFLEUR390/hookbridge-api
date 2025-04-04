<?php

declare(strict_types=1);

namespace Database\Seeders\V1;

use App\Models\V1\Project;
use Illuminate\Database\Seeder;

final class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Project::factory(10)->create();
    }
}
