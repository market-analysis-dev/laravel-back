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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('contact_name', 255)->nullable();
            $table->string('contact_phone', 50)->nullable();
            $table->string('contact_email', 255)->nullable();
            $table->string('contact_comments', 255)->nullable();
            $table->boolean('is_direct_contact')->default(false);
            $table->boolean('is_land_contact')->default(false);
            $table->boolean('is_buildings_contact')->default(false);
            $table->boolean('is_broker_contact')->default(false);
            $table->boolean('is_developer_contact')->default(false);
            $table->boolean('is_owner_contact')->default(false);
            $table->boolean('is_company_contact')->default(false);
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
        Schema::dropIfExists('contacts');
    }
};
