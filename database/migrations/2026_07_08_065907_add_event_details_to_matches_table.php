<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->string('league')->nullable()->after('sport');
            $table->string('stage')->nullable()->after('league');
            $table->string('venue')->nullable()->after('stage');
            $table->unsignedInteger('duration_minutes')->nullable()->after('best_of');

            $table->string('team_a_logo')->nullable()->after('team_a_color');
            $table->string('team_b_logo')->nullable()->after('team_b_color');
        });
    }

    public function down(): void
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->dropColumn([
                'league',
                'stage',
                'venue',
                'duration_minutes',
                'team_a_logo',
                'team_b_logo',
            ]);
        });
    }
};