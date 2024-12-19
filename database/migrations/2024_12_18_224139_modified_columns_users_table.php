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
        // Eliminar la tabla users si existe
        Schema::dropIfExists('users');

        // Crear la tabla users con el nuevo orden de columnas
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('user_name')->unique();
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('user_type_id')->unsigned()->nullable();
            $table->integer('total_screens')->default(0);
            $table->string('password');
            $table->rememberToken();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
