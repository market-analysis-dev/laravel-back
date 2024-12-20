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
        $tableNames = config('permission.table_names');

        Schema::table($tableNames['permissions'], function (Blueprint $table) {
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->index('created_by');
            $table->index('updated_by');
        });
        Schema::table($tableNames['roles'], function (Blueprint $table) {
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->index('created_by');
            $table->index('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableNames = config('permission.table_names');

        Schema::table($tableNames['permissions'], function (Blueprint $table) {
            $table->dropIndex('created_by');
            $table->dropIndex('updated_by');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
        Schema::table($tableNames['roles'], function (Blueprint $table) {
            $table->dropIndex('created_by');
            $table->dropIndex('updated_by');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
};
