<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('overlay_settings', function (Blueprint $table) {
            $table->foreignId('overlay_template_id')
                ->nullable()
                ->after('match_id')
                ->constrained('overlay_templates')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('overlay_settings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('overlay_template_id');
        });
    }
};