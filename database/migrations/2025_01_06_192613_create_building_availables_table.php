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
            $table->foreignId('abs_tenant_id')->nullable()->constrained('cat_tenants');
            $table->foreignId('abs_industry_id')->nullable()->constrained('cat_industries');
            $table->foreignId('abs_country_id')->nullable()->constrained('countries');
            $table->foreignId('broker_id')->constrained('cat_brokers');
            $table->foreignId('abs_shelter_id')->nullable()->constrained('cat_shelters');
            $table->foreignId('building_available_id')->nullable()->constrained('buildings_available', 'id');
            $table->integer('size_sf')->nullable(false)->default(0);
            $table->string('building_dimensions_ft', 45)->nullable(false)->default(0);
            $table->integer('avl_minimum_space_sf')->nullable(false)->default(0);
            $table->unsignedInteger('construction_size_sf')->nullable(false)->default(0);
            $table->integer('dock_doors')->nullable(false)->default(0);
            $table->integer('ramps')->nullable(false)->default(0);
            $table->integer('truck_court_ft')->nullable(false)->default(0);
            $table->string('kvas_fees_paid', 20)->nullable();
            $table->boolean('shared_truck')->nullable();
            $table->boolean('is_new_construction')->nullable();
            $table->boolean('is_starting_construction')->nullable();
            $table->string('bay_size', 45)->nullable();
            $table->date('avl_date')->nullable();
            $table->integer('abs_lease_term_month')->nullable();
            $table->integer('parking_space')->nullable(false)->default(0);
            $table->integer('trailer_parking_space')->nullable(false)->default(0);
            $table->decimal('avl_min_lease', 18, 2)->nullable(false)->default(0);
            $table->decimal('avl_max_lease', 18, 2)->nullable(false)->default(0);
            $table->decimal('abs_asking_shell', 18, 2)->nullable(false)->default(0);

            $table->decimal('abs_closing_rate', 18, 2)->nullable(false)->default(0);
            $table->unsignedInteger('abs_closing_dock_door')->default(0);
            $table->unsignedSmallInteger('abs_closing_knockout_docks')->default(0);
            $table->unsignedInteger('abs_closing_ramps')->default(0);
            $table->unsignedInteger('abs_closing_truck_court')->default(0);
            $table->enum('abs_closing_currency', ['USD', 'MXP']);
            $table->unsignedInteger('avl_sale_price')->default(0);




            $table->date('abs_closing_date')->nullable();
            $table->date('abs_lease_up')->nullable();
            $table->string('abs_month', 20)->nullable();
            $table->decimal('abs_sale_price', 18, 2)->nullable();
            $table->integer('offices_space_sf')->default(0);
            $table->unsignedSmallInteger('knockout_docks')->nullable()->default(0);
            $table->enum('building_state', ['Availability', 'Absorption']);
            $table->enum('avl_type', ['Construction', 'Planned', 'Sublease', 'Expiration', 'Inventory'])->nullable();
            $table->enum('abs_type', ['Inventory', 'Inventory Expansion', 'BTS', 'BTS Expansion'])->nullable();
            $table->enum('abs_final_use', ['Logistic', 'Manufacturing', 'TBD'])->nullable();
            $table->enum('abs_company_type', ['Existing Company', 'New Company in Market', 'New Company in Mexico'])->nullable();
            $table->enum('abs_deal', ['Sale', 'Lease']);
            $table->enum('avl_deal', ['Sale', 'Lease']);
            $table->set('fire_protection_system', ["Hose Station", "Sprinkler", "Extinguisher"])->nullable();

            $table->boolean('has_tis_hvac')->default(0);
            $table->boolean('has_tis_crane')->default(0);
            $table->boolean('has_tis_rail_spur')->default(0);
            $table->boolean('has_tis_sprinklers')->default(0);
            $table->boolean('has_tis_crossdock')->default(0);
            $table->boolean('has_tis_office')->default(0);
            $table->boolean('has_tis_leed')->default(0);
            $table->boolean('has_tis_land_expansion')->default(0);



            $table->boolean('is_negative_absorption')->default(false);
            $table->enum('status', ['Enabled', 'Disabled', 'Draft'])->default('Enabled');
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
