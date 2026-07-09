<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('sport')->nullable();
            $table->unsignedInteger('best_of')->nullable();
            $table->string('status')->default('scheduled'); // live | scheduled | ended

            $table->string('team_a')->nullable();
            $table->foreignId('team_a_id')->nullable()->constrained('teams')->nullOnDelete();

            $table->string('team_b')->nullable();
            $table->foreignId('team_b_id')->nullable()->constrained('teams')->nullOnDelete();

            $table->string('team_a_color')->nullable();
            $table->string('team_b_color')->nullable();

            $table->integer('score_a')->default(0);
            $table->integer('score_b')->default(0);

            $table->unsignedInteger('clock_seconds')->default(0);
            $table->enum('timer_status', ['stopped', 'running', 'paused'])->default('stopped');
            $table->timestamp('clock_updated_at')->nullable();
            $table->string('period')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};