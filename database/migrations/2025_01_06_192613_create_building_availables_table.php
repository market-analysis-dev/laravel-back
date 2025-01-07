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
        Schema::create('buildings_available', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->constrained('buildings');
            $table->foreignId('abs_tenant_id')->constrained('cat_tenants');
            $table->foreignId('abs_industry_id')->constrained('cat_industries');
            $table->foreignId('abs_country_id')->constrained('countries');
            $table->foreignId('broker_id')->constrained('cat_developers');
            $table->integer('avl_size_sf');
            $table->string('avl_building_dimensions', 45);
            $table->integer('avl_minimum_space_sf')->nullable();
            $table->integer('avl_expansion_up_to_sf')->nullable();
            $table->integer('dock_doors')->nullable();
            $table->integer('drive_in_door')->nullable();
            $table->integer('floor_thickness')->nullable();
            $table->string('floor_resistance', 255)->nullable();
            $table->integer('truck_court')->nullable();
            $table->boolean('has_crossdock')->nullable();
            $table->boolean('shared_truck')->nullable();
            $table->boolean('new_construction')->nullable();
            $table->boolean('is_starting_construction')->nullable();
            $table->string('bay_size', 45)->nullable();
            $table->string('columns_spacing', 45)->nullable();
            $table->date('avl_date')->nullable();
            $table->integer('abs_lease_term_month')->nullable();
            $table->integer('knockouts_docks')->nullable();
            $table->integer('parking_space')->nullable();
            $table->decimal('avl_min_lease', 18, 2);
            $table->decimal('avl_max_lease', 18, 2);
            $table->decimal('abs_asking_rate_shell', 18, 2);
            $table->decimal('abs_closing_rate', 18, 2);
            $table->date('abs_closing_date')->nullable();
            $table->date('abs_lease_up')->nullable();
            $table->date('abs_month')->nullable();
            $table->decimal('abs_sale_price', 18, 2)->nullable();
            $table->enum('building_state', ['Availability', 'Absorption']);
            $table->enum('avl_building_phase', ['Construction', 'Planned', 'Sublease', 'Expiration', 'Inventory']);
            $table->enum('abs_building_phase', ['BTS', 'Expansion', 'Inventory']);
            $table->enum('abs_final_use', ['Logistic', 'Manufacturing'])->nullable();
            $table->enum('abs_company_type', ['Existing Company', 'New Company in Market', 'New Company in Mexico'])->nullable();
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
        Schema::dropIfExists('buildings_available');
    }
};
