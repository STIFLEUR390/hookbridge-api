<?php

declare(strict_types=1);

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
        Schema::create('project_targets', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('project_id')->constrained('projects');
            $table->string('url')->comment('URL of the target webhook');
            $table->boolean('requires_authentication')->default(false);
            $table->string('secret')->nullable()->comment('Secret for Webhook authentication');
            $table->boolean('active')->default(true);

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
        Schema::dropIfExists('project_targets');
    }
};
