<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('overlay_templates', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('category', [
                'scoreboard', 'team', 'lower_third', 'sponsor',
                'penalties', 'titles', 'substitution',
            ]);
            $table->string('sport')->nullable(); // null = works for any sport

            $table->string('accent_color')->default('#7C3AED');
            $table->string('secondary_color')->nullable();
            $table->string('layout_style'); // drives which CSS preview markup renders

            $table->json('config'); // pre-fills overlay_settings fields on apply

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('overlay_templates');
    }
};