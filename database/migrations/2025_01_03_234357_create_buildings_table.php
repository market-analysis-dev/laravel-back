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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')->references('id')->on('cat_regions')->onDelete('cascade');
            $table->unsignedBigInteger('market_id');
            $table->foreign('market_id')->references('id')->on('cat_markets')->onDelete('cascade');
            $table->unsignedBigInteger('sub_market_id');
            $table->foreign('sub_market_id')->references('id')->on('cat_submarkets')->onDelete('cascade');
            $table->unsignedBigInteger('builder_id');
            $table->foreign('builder_id')->references('id')->on('building_contacts')->onDelete('cascade');
            $table->unsignedBigInteger('industrial_park_id');
            $table->foreign('industrial_park_id')->references('id')->on('industrial_parks')->onDelete('cascade');
            $table->unsignedBigInteger('developer_id');
            $table->foreign('developer_id')->references('id')->on('building_contacts')->onDelete('cascade');
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('building_contacts')->onDelete('cascade');
            $table->unsignedBigInteger('user_owner_id');
            $table->foreign('user_owner_id')->references('id')->on('building_contacts')->onDelete('cascade');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->foreign('contact_id')->references('id')->on('building_contacts')->onDelete('cascade');
            $table->string('building_name', 255);
            $table->enum('class', ['A', 'B', 'C']);
            $table->integer('building_size_sf');
            $table->enum('building_phase', ['BTS', 'Expansion', 'Inventory', 'Construction', 'Planned', 'Sublease', 'Expiration']);
            $table->enum('type_generation', ['1st Generation', '2nd Generation']);
            $table->enum('currency', ['USD', 'MXP']);
            $table->enum('tenancy', ['Single', 'Multitenant']);
            $table->string('latitud', 45);
            $table->string('longitud', 45);
            $table->integer('year_built')->nullable();
            $table->integer('clear_height')->nullable();
            $table->decimal('total_land', 18, 0)->nullable();
            $table->integer('offices_space')->nullable();
            $table->boolean('has_expansion_land');
            $table->boolean('has_crane');
            $table->boolean('has_hvac');
            $table->boolean('has_rail_spur');
            $table->boolean('has_sprinklers');
            $table->boolean('has_office');
            $table->boolean('has_leed');
            $table->boolean('new_construction');
            $table->boolean('starting_construction');
            $table->string('hvac_production_area', 45)->nullable();
            $table->enum('construction_type', ['TILT_UP', 'Precast', 'Block & Sheet Metal', 'Sheet Metal'])->nullable();
            $table->enum('lightning', ['LED 350 LUXES', 'T5', 'Metal Halide'])->nullable();
            $table->string('ventilation', 45)->nullable();
            $table->string('transformer_capacity', 45)->nullable();
            $table->string('construction_state', 45)->nullable();
            $table->string('roof_system', 45)->nullable();
            $table->enum('fire_protection_system', ['Hose Station', 'Sprinkler', 'Extinguisher']);
            $table->string('skylights_sf', 45)->nullable();
            $table->string('coverage', 45)->nullable();
            $table->string('kvas', 45)->nullable();
            $table->enum('deal', ['Sale', 'Lease']);
            $table->enum('loading_door', ['Crossdock', 'Back Loading', 'Front Loading'])->nullable();
            $table->enum('above_market_tis', ['HVAC', 'CRANE', 'Rail Spur', 'Sprinklers', 'Crossdock', 'Office', 'Leed', 'Land Expansion'])->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Pending', 'Approved']);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
