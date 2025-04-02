<?php

namespace Database\Seeders\V1;

use App\Models\V1\IncomingRequest;
use Illuminate\Database\Seeder;

class IncomingRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        IncomingRequest::factory()
            ->count(10)
            ->create();
    }
}
