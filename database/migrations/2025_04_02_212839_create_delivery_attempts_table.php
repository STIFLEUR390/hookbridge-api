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
        Schema::create('delivery_attempts', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('incoming_request_id')->constrained('incoming_requests');
            $table->foreignId('project_target_id')->constrained('project_targets');
            $table->unsignedInteger('attempt_count')->default(0)->comment('Nombre de tentatives de livraison');
            $table->enum('status', ['pending', 'in_progress', 'success', 'failed'])->comment('Statut de la tentative de livraison');
            $table->unsignedInteger('response_code')->nullable()->comment('Code de réponse HTTP');
            $table->text('response_body')->nullable()->comment('Corps de la réponse HTTP');
            $table->timestamp('next_attempt_at')->nullable()->comment('Date de la prochaine tentative de livraison');
            $table->timestamp('last_attempt_at')->nullable()->comment('Date de la dernière tentative de livraison');

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
        Schema::dropIfExists('deliveryAttempts');
    }
};
