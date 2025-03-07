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
        Schema::create('reits_timeline', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reit_id')->constrained('cat_reits');
            $table->string('name', 100);
            $table->enum('type', ['initial', 'buys', 'contract', 'development', 'expansion', 'opening', 'sale', 'land', 'canceled']);
            $table->unsignedSmallInteger('property');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reits_timeline');
    }
};
