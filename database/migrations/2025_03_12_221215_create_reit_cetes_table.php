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
        Schema::create('reit_cetes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reit_id')->constrained('cat_reits');
            $table->foreignId('reit_type_id')->constrained('cat_reit_types');
            $table->smallInteger('year')->unsigned();
            $table->enum('quarter', ['Q1', 'Q2', 'Q3', 'Q4']);
            $table->decimal('cbdfi', 10, 8);
            $table->decimal('present_value', 10, 2);
            $table->decimal('return', 5, 2);
            $table->decimal('real_return', 5, 2);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reit_cetes');
    }
};
