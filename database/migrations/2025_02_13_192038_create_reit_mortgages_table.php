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
        Schema::create('reit_mortgages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reit_id')->constrained('cat_reits');
            $table->foreignId('reit_type_id')->constrained('cat_reit_types');
            $table->smallInteger('year');
            $table->char('quarter', 2);
            $table->decimal('net_income', 5, 2);
            $table->decimal('return_on_enquity', 5, 2);
            $table->decimal('return_on_assets', 5, 2);
            $table->decimal('return_on_invested_capital', 5, 2);
            $table->decimal('interest_income', 10, 2);
            $table->decimal('number_loans', 8, 2);
            $table->decimal('outstanding_portfolio', 5, 2);
            $table->decimal('overdue_portfolio', 5, 2);
            $table->decimal('avg_interest_rate_fovisste', 5, 2);
            $table->decimal('avg_interest_rate_pdh', 5, 2);
            $table->decimal('dollar', 5, 2);
            $table->decimal('divided_yield', 5, 2);
            $table->decimal('total_portfolio', 8, 2);
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
        Schema::dropIfExists('reit_mortgages');
    }
};
