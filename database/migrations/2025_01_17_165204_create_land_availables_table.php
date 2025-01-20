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
        Schema::create('lands_available', function (Blueprint $table) {
            $table->id();
            $table->foreignId('land_id')->constrained('lands', 'id');
            $table->foreignId('abs_company_id')->nullable()->constrained('companies', 'id');
            $table->foreignId('avl_broker_id')->nullable()->constrained('cat_developers', 'id');
            $table->foreignId('abs_country_id')->nullable()->constrained('countries', 'id');
            $table->foreignId('abs_broker_id')->nullable()->constrained('cat_developers', 'id');
            $table->enum('land_state', ['Availability', 'Absorption']);
            $table->integer('avl_size_sm')->nullable();
            $table->decimal('avl_land_sm', 18, 0)->nullable();
            $table->integer('avl_minimum')->nullable();
            $table->decimal('avl_min_sale', 18, 2)->nullable();
            $table->decimal('avl_max_sale', 18, 2)->nullable();
            $table->enum('avl_zoning', ['Industrial'])->nullable();
            $table->enum('avl_pacel_shape', ['Regular', 'Irregular'])->nullable();
            $table->boolean('avl_rail_spur')->nullable();
            $table->boolean('avl_natural_gas')->nullable();
            $table->boolean('avl_sewage')->nullable();
            $table->boolean('avl_water')->nullable();
            $table->boolean('avl_electric')->nullable();
            $table->boolean('avl_conditioned_construction')->nullable();
            $table->integer('avl_quarter')->nullable();
            $table->integer('avl_year')->nullable();
            $table->enum('land_condition', ['Fully Developed', 'Undeveloped'])->nullable();
            $table->integer('abs_size_HA')->nullable();
            $table->integer('abs_quarter')->nullable();
            $table->integer('abs_year')->nullable();
            $table->decimal('abs_closing_price', 18, 2)->nullable();
            $table->enum('abs_type_buyer', ['User', 'Developer'])->nullable();
            $table->enum('abs_company_type', ['Existing Company', 'New Company in Market', 'New Company in Mexico'])->nullable();
            $table->string('comments', 45)->nullable();
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
        Schema::dropIfExists('lands_available');
    }
};
