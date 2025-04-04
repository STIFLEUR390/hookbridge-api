<?php

declare(strict_types=1);

namespace Database\Seeders\V1;

use App\Models\V1\ProjectTarget;
use Illuminate\Database\Seeder;

final class ProjectTargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ProjectTarget::factory(10)->create();
    }
}
