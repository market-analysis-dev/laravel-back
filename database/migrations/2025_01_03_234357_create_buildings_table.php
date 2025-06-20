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
            $table->foreignId('region_id')->constrained('cat_regions');
            $table->foreignId('market_id')->constrained('cat_markets');
            $table->foreignId('sub_market_id')->constrained('cat_sub_markets');
            $table->foreignId('builder_id')->constrained('cat_developers');
            $table->foreignId('industrial_park_id')->constrained('industrial_parks');
            $table->foreignId('developer_id')->nullable()->constrained('cat_developers');
            $table->foreignId('owner_id')->nullable()->constrained('cat_developers');

            $table->string('building_name', 255);
            $table->integer('building_size_sf')->nullable(false)->default(0);
            $table->string('latitud', 45)->nullable();
            $table->string('longitud', 45)->nullable();
            $table->integer('year_built')->nullable();
            $table->integer('clear_height_ft')->nullable(false)->default(0);
            $table->integer('total_land_sf')->nullable(false)->default(0);
            $table->string('hvac_production_area', 45)->nullable();
            $table->string('ventilation', 45)->nullable();
            $table->enum('roofing', ['Butler', 'KR18', 'KR24', 'SSR LOK', 'TPO'])->nullable();
            $table->string('skylights_sf', 45)->nullable(false)->default(0);
            $table->string('coverage', 45)->nullable(false)->default(0);
            $table->string('transformer_capacity', 20)->nullable();
            $table->boolean('expansion_land')->nullable();
            $table->string('columns_spacing_ft', 20)->nullable(false)->default(0);
            $table->integer('floor_thickness_in')->nullable(false)->default(0);
            $table->string('floor_resistance', 255)->nullable(false)->default(0);
            $table->integer('expansion_up_to_sf')->default(0)->nullable(false);
            $table->enum('class', ['A', 'B', 'C']);
            $table->enum('generation', ['1st Generation', '2nd Generation']);
            $table->enum('currency', ['USD', 'MXP']);
            $table->enum('tenancy', ['Single', 'Multitenant']);
            $table->enum('construction_type', ['Precast', 'Tiltup', 'Concrete Masonry & Metal Sheet', 'Hebel','Concrete Masonry', 'Metal Sheet'])->nullable();
            $table->enum('lightning', ['LED','T5','T8','Metal Halide','None'])->nullable();

            $table->enum('loading_door', ['Crossdock', 'Back Loading', 'Front Loading'])->nullable();
            $table->enum('building_type', ['Spec', 'BTS', 'BTS Expansion', 'Expansion']);
            $table->enum('certifications', ['None', 'LEED', 'EDGE', 'BOMA']);
            $table->enum('owner_type', ['Investor', 'REITS', 'Developer', 'User Owner', 'Builder', 'Private Owner']);
            $table->enum('stage', ['Availability', 'Construction', 'Leased', 'Sold']);
            $table->date('construction_date')->nullable();

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
        Schema::dropIfExists('buildings');
    }
};
