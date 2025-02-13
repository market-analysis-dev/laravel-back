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
        Schema::create('reit_annuals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reit_id')->constrained('cat_reits');
            $table->smallInteger('year');
            $table->char('quarter', 2)->nullable();
            $table->decimal('noi', 6, 2);
            $table->decimal('cap_rate', 4, 2);
            $table->decimal('occupancy', 6, 2);
            $table->bigInteger('m2')->unsigned()->nullable();
            $table->decimal('sqft', 12, 2);
            $table->unsignedInteger('buildings');
            $table->decimal('customer_retention_rate', 6, 2);
            $table->decimal('average_rent', 6, 2);
            $table->decimal('contracts', 4, 2);
            $table->decimal('rental_income', 8, 2);
            $table->decimal('dolar', 5, 2);
            $table->decimal('prop_investment', 8, 2);
            $table->enum('type', ['annual', 'quarter']);
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
        Schema::dropIfExists('reit_annuals');
    }
};
