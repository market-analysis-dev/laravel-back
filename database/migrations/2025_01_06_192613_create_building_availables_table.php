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
            $table->unsignedBigInteger('building_id');
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
            $table->unsignedBigInteger('abs_tenant_id');
            $table->foreign('abs_tenant_id')->references('id')->on('cat_tenants')->onDelete('cascade');
            $table->unsignedBigInteger('abs_industry_id');
            $table->foreign('abs_industry_id')->references('id')->on('cat_industries')->onDelete('cascade');
            $table->unsignedBigInteger('abs_country_id');
            $table->foreign('abs_country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->unsignedBigInteger('broker_id');
            $table->foreign('broker_id')->references('id')->on('building_contacts')->onDelete('cascade');
            $table->enum('building_state', ['Availability', 'Absorption']);
            $table->integer('avl_size_sf');
            $table->string('avl_building_dimensions', 45);
            $table->enum('avl_building_phase', ['Construction', 'Planned', 'Sublease', 'Expiration', 'Inventory']);
            $table->enum('abs_building_phase', ['BTS', 'Expansion', 'Inventory']);
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
            $table->enum('abs_final_use', ['Logistic', 'Manufacturing'])->nullable();
            $table->enum('abs_company_type', ['Existing Company', 'New Company in Market', 'New Company in Mexico'])->nullable();
            $table->decimal('abs_sale_price', 18, 2)->nullable();
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
        Schema::dropIfExists('buildings_available');
    }
};
