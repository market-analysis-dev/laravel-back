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
        Schema::create('market_growths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->constrained('buildings');
            $table->foreignId('owner_id')->constrained('cat_developers');
            $table->foreignId('developer_id')->constrained('cat_developers');
            $table->foreignId('builder_id')->constrained('cat_developers');
            $table->foreignId('industrial_park_id')->constrained('industrial_parks');
            $table->foreignId('region_id')->constrained('cat_regions');
            $table->foreignId('market_id')->constrained('cat_markets');
            $table->foreignId('sub_market_id')->constrained('cat_sub_markets');
            $table->bigInteger('size_sf');
            $table->enum('deal', ['Sale', 'Lease']);
            $table->enum('type', ['BTS', 'Expansion', 'Inventory']);

            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->string('comments', 255)->nullable();

            $table->string('latitude', 20)->nullable();
            $table->string('longitude', 20)->nullable();
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
        Schema::dropIfExists('market_growths');
    }
};
