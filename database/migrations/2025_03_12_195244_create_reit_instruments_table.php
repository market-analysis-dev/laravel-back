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
        Schema::create('reit_instruments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reit_type_id')->constrained('cat_reit_types');
            $table->string('name', 50);
            $table->decimal('present_value', 10, 2);
            $table->decimal('return', 5, 2);
            $table->decimal('real_return', 5, 2);
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
        Schema::dropIfExists('reit_instruments');
    }
};
