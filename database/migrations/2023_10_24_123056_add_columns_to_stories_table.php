<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->string('title_lv')->nullable()->after('title');
            $table->string('description_lv')->nullable()->after('description');
            $table->string('location_lv')->nullable()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn('title_lv');
            $table->dropColumn('description_lv');
            $table->dropColumn('location_lv');
        });
    }
};
