<?php

declare(strict_types=1);

use App\Enums\ProjectType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('allowed_domain');
            $table->string('allowed_subdomain')->nullable();
            $table->string('header')->nullable();
            $table->json('provider_config')->nullable();
            $table->string('uuid')->nullable();
            $table->boolean('active')->default(true);
            $table->enum('type', ProjectType::values())->default(ProjectType::WEBHOOK->value);
            $table->foreignId('user_id')->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
