<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('overlay_templates', function (Blueprint $table) {
            $table->string('thumbnail')->nullable()->after('sport');
            $table->string('blade_view')->after('layout_style');   // e.g. "dark-blue" -> overlay.templates.dark-blue
            $table->string('css_file')->nullable()->after('blade_view'); // e.g. "dark-blue" -> resources/css/overlay/templates/dark-blue.css
            $table->string('js_file')->nullable()->after('css_file');
            $table->text('description')->nullable()->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('overlay_templates', function (Blueprint $table) {
            $table->dropColumn(['thumbnail', 'blade_view', 'css_file', 'js_file', 'description']);
        });
    }
};