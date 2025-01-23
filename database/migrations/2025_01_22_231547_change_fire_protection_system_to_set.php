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
        Schema::table('buildings', function (Blueprint $table) {
            DB::statement('ALTER TABLE buildings CHANGE fire_protection_system fire_protection_system SET("Hose Station", "Sprinkler", "Extinguisher")');
            DB::statement('ALTER TABLE buildings CHANGE above_market_tis above_market_tis SET("HVAC", "CRANE", "Rail Spur", "Sprinklers", "Crossdock", "Office", "Leed", "Land Expansion")');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buildings', function (Blueprint $table) {
            $table->enum('fire_protection_system', ['Hose Station', 'Sprinkler', 'Extinguisher'])->change();
            $table->enum('above_market_tis', ['HVAC', 'CRANE', 'Rail Spur', 'Sprinklers', 'Crossdock', 'Office', 'Leed', 'Land Expansion'])->change();
        });
    }
};
