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
        Schema::create('transactions', function (Blueprint $table) {
            Schema::create('transactions', function (Blueprint $table) {
                $table->id();
    
                $table->string('ref_no', 255)->nullable(false);
                $table->bigInteger('receiving_company_id')->unsigned()->nullable();
                $table->foreign('receiving_company_id')->references('id')->on('companies');
                $table->bigInteger('paying_company_id')->unsigned()->nullable();
                $table->foreign('paying_company_id')->references('id')->on('companies');
                $table->date('date')->nullable(false)->default(now());
                $table->bigInteger('transaction_id')->unsigned()->nullable();
                $table->foreign('transaction_id')->references('id')->on('transactions');
                $table->string('product_service_name', 255)->nullable(false);
                $table->string('description', 255)->nullable();
                $table->decimal('amount_payable', 18, 2)->nullable(false)->default(0)->unsigned();
                $table->decimal('amount_paid', 18, 2)->nullable()->unsigned();
                $table->string('remark', 255)->nullable();
                $table->bigInteger('created_by')->unsigned()->nullable();
                $table->foreign('created_by')->references('id')->on('users');
                $table->bigInteger('updated_by')->unsigned()->nullable();
                $table->foreign('updated_by')->references('id')->on('users');

                $table->timestamps();
                $table->softDeletes();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
