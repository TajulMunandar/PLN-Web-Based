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
        Schema::table('foto_assets', function (Blueprint $table) {
            // Drop the old foreign key constraint
            $table->dropForeign(['id_asset']);

            // Add the new foreign key constraint with cascading delete
            $table->foreign('id_asset')
                ->references('id')->on('assets')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('foto_assets', function (Blueprint $table) {
            // Drop the foreign key constraint to revert
            $table->dropForeign(['id_asset']);

            // Re-add the old foreign key constraint (without cascade)
            $table->foreign('id_asset')
                ->references('id')->on('assets')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }
};
