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
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('company_id')->unsigned()->nullable(false);
            $table->foreign('company_id')->references('id')->on('companies');
            $table->date('date')->nullable(false)->default(now());
            $table->string('sales_name', 255)->nullable(false);
            $table->decimal('sales_amount', 18, 2)->nullable(false)->default(0)->unsigned();
            $table->decimal('cost_of_sales', 18, 2)->nullable(false)->default(0)->unsigned();
            $table->string('description', 255)->nullable();
            $table->string('remark', 255)->nullable();
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
        Schema::dropIfExists('revenues');
    }
};
