<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('overlay_settings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('match_id')
                ->unique()
                ->constrained('matches')
                ->cascadeOnDelete();

            $table->string('theme')->default('default');           // default | minimal | broadcast-bold
            $table->string('animation_style')->default('fade');    // none | fade | slide
            $table->string('accent_color')->nullable();            // overrides team colors if set

            $table->boolean('show_logos')->default(true);
            $table->boolean('show_timer')->default(true);
            $table->boolean('show_score')->default(true);
            $table->boolean('show_period')->default(true);
            $table->boolean('show_sponsor')->default(false);
            $table->boolean('show_ticker')->default(false);

            $table->string('sponsor_logo')->nullable();
            $table->string('ticker_text')->nullable();

            $table->boolean('is_live')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('overlay_settings');
    }
};