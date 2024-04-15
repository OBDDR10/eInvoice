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
        Schema::create('profit_loss_statements', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('company_id')->unsigned()->nullable(false);
            $table->foreign('company_id')->references('id')->on('companies');
            $table->date('date')->nullable(false)->default(now());
            $table->decimal('total_net_sales', 18, 2)->nullable(false)->default(0)->unsigned();
            $table->decimal('total_cost_of_sales', 18, 2)->nullable(false)->default(0)->unsigned();
            $table->decimal('gross_margin', 18, 2)->nullable(false)->default(0)->signed();
            $table->decimal('other_income_expense', 18, 2)->nullable()->signed();
            $table->decimal('income_before_tax', 18, 2)->nullable(false)->default(0)->signed();
            $table->decimal('tax_rate', 18, 2)->nullable(false)->default(0)->unsigned();
            $table->decimal('tax_paid', 18, 2)->nullable(false)->default(0)->signed();
            $table->decimal('net_income', 18, 2)->nullable(false)->default(0)->signed();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profit_loss_statements');
    }
};
