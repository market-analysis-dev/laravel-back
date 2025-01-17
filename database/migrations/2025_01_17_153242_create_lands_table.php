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
        Schema::create('lands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained('cat_regions', 'id');
            $table->foreignId('market_id')->constrained('cat_markets', 'id');
            $table->foreignId('sub_market_id')->constrained('cat_submarkets', 'id');
            $table->foreignId('industrial_park_id')->constrained('cat_industrial_parks', 'id');
            $table->foreignId('developer_id')->constrained('cat_developers');
            $table->foreignId('owner_id')->constrained('cat_developers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lands');
    }
};
