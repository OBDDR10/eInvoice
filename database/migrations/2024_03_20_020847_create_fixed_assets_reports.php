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
        Schema::create('fixed_assets_reports', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('company_id')->unsigned()->nullable(false);
            $table->foreign('company_id')->references('id')->on('companies');
            $table->date('date')->nullable(false)->default(now());
            $table->decimal('cost_opening_balance', 18, 2)->nullable()->default(0)->unsigned();
            $table->decimal('depreciation_opening_balance', 18, 2)->nullable()->default(0)->signed();
            $table->decimal('net_book_value_opening_balance', 18, 2)->nullable()->default(0)->signed();
            $table->decimal('cost_addition', 18, 2)->nullable()->default(0)->signed();
            $table->decimal('depreciation_addition', 18, 2)->nullable()->default(0)->signed();
            $table->decimal('net_book_value_addition', 18, 2)->nullable()->default(0)->signed();
            $table->decimal('cost_disposal', 18, 2)->nullable()->default(0)->signed();
            $table->decimal('depreciation_disposal', 18, 2)->nullable()->default(0)->signed();
            $table->decimal('net_book_value_disposal', 18, 2)->nullable()->default(0)->signed();
            $table->decimal('cost_closing_balance', 18, 2)->nullable()->default(0)->signed();
            $table->decimal('depreciation_closing_balance', 18, 2)->nullable()->default(0)->signed();
            $table->decimal('net_book_value_closing_balance', 18, 2)->nullable()->default(0)->signed();
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
        Schema::dropIfExists('fixed_assets_reports');
    }
};
