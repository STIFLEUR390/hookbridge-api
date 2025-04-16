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
        Schema::create('incoming_requests', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('project_id')->constrained('projects');
            $table->enum('type', ['callback', 'webhook']);
            $table->enum('http_method', ['GET', 'POST']);
            $table->json('headers')->nullable();
            $table->json('payload')->nullable();
            $table->enum('status', ['new', 'processing', 'processed', 'failed'])->default('new');
            $table->timestamp('received_at');

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
        Schema::dropIfExists('incomingRequests');
    }
};