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
        Schema::create('cams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('industrial_park_id')->constrained('cat_industrial_parks');
            $table->foreignId('developer_id')->constrained('cat_developers');
            $table->foreignId('region_id')->constrained('cat_regions');
            $table->foreignId('market_id')->constrained('cat_markets');
            $table->foreignId('submarket_id')->constrained('cat_submarkets');
            $table->decimal('cam_building_sf', 5, 2);
            $table->decimal('cam_land_sf', 5, 2);
            $table->boolean('has_gardening_maintenance')->default(false);
            $table->boolean('has_lightning_maintenance')->default(false);
            $table->boolean('has_park_administration')->default(false);
            $table->boolean('storm_sewer_maintenance')->default(false);
            $table->boolean('has_survelliance')->default(false);
            $table->boolean('has_management_fee')->default(false);
            $table->enum('currency', ['USD', 'MXP']);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cams');
    }
};
