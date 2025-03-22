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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_fr')->after('name');
            $table->string('name_en')->after('name_fr');
            $table->string('name_it')->after('name_en');
            $table->dropColumn('name'); // Remove the old name column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->dropColumn(['name_fr', 'name_en', 'name_it']);
        });
    }
};
