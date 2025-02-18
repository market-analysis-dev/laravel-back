<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('permissions_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->foreignId('market_id')->constrained('markets')->onDelete('cascade');
            $table->foreignId('sub_market_id')->constrained('sub_markets')->onDelete('cascade');
            $table->integer('year')->nullable();
            $table->string('quarter')->nullable();
            $table->enum('status', ['Activo', 'Inactivo'])->default('Activo');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
        });

        Schema::create('permissions_unique', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('permission_id')->constrained('permissions_policies')->onDelete('cascade');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
        });

        Schema::create('permissions_submodules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('sub_module_id')->constrained('sub_modules')->onDelete('cascade');
            $table->enum('status', ['Activo', 'Inactivo'])->default('Activo');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('permissions_submodules');
        Schema::dropIfExists('permissions_unique');
        Schema::dropIfExists('permissions_policies');
    }
};
