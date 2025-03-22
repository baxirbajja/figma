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
        Schema::table('ingredients', function (Blueprint $table) {
            // Drop existing columns
            $table->dropColumn(['name', 'description', 'unit', 'cost_per_unit', 'stock', 'active']);

            // Add new columns
            $table->string('reference')->unique();
            $table->string('name_fr');
            $table->string('name_en');
            $table->string('name_it');
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingredients', function (Blueprint $table) {
            // Drop new columns
            $table->dropColumn(['reference', 'name_fr', 'name_en', 'name_it', 'is_active']);

            // Restore original columns
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('unit');
            $table->decimal('cost_per_unit', 8, 2);
            $table->integer('stock');
            $table->boolean('active')->default(true);
        });
    }
};
