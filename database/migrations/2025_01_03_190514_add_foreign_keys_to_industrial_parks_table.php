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
        Schema::table('industrial_parks', function (Blueprint $table) {
            $table->foreign('market_id')
                ->references('id')
                ->on('cat_markets')
                ->nullOnDelete();

            $table->foreign('sub_market_id')
                ->references('id')
                ->on('cat_submarkets')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('industrial_parks', function (Blueprint $table) {
            $table->dropForeign(['market_id']);
            $table->dropForeign(['sub_market_id']);
        });
    }
};
