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
        Schema::table('locations', function (Blueprint $table) {
            $table->string('location_lv')->nullable()->after('location');
            $table->string('location_title_lv')->nullable()->after('location_title');
            $table->longText('description_lv')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('location_lv');
            $table->dropColumn('location_title_lv');
            $table->dropColumn('description_lv');
        });
    }
};
