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
            $table->foreignId('abs_industry_id')->nullable()->constrained('cat_industries');
            $table->bigInteger('avl_size_ha')->nullable();
            $table->integer('avl_minimum')->nullable();
            $table->decimal('avl_min_sale', 18, 2)->nullable();
            $table->decimal('avl_max_sale', 18, 2)->nullable();
            $table->bigInteger('kvas')->nullable();
            $table->integer('abs_size_ha')->nullable();
            $table->decimal('abs_closing_price', 18, 2)->nullable();
            $table->decimal('abs_kvas_price', 18, 2)->nullable();
            $table->boolean('avl_conditioned_construction')->nullable();
            $table->boolean('rail_spur')->nullable();
            $table->string('avl_comments', 45)->nullable();
            $table->string('abs_comments', 45)->nullable();
            $table->enum('state', ['Availability', 'Absorption']);
            $table->enum('natural_gas', ['yes','no','feasibility'])->nullable();
            $table->enum('sewage', ['yes','no','feasibility'])->nullable();
            $table->enum('water', ['yes','no','feasibility'])->nullable();
            $table->enum('electric', ['yes','no','feasibility'])->nullable();
            $table->enum('abs_final_use', ['Logistic', 'Manufacturing','TBD'])->nullable();
            $table->enum('land_condition', ['Fully Developed', 'Undeveloped'])->nullable();
            $table->date('avl_date')->nullable();
            $table->date('abs_date')->nullable();
            $table->enum('avl_deal', ['Lease', 'Sale']);
            $table->enum('abs_company_type', ['Existing Company', 'New Company in Market', 'New Company in Mexico'])->nullable();
            $table->enum('abs_type_buyer', ['User', 'Developer'])->nullable();
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
