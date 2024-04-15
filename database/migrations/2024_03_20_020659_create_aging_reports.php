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
        Schema::create('aging_reports', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('company_id')->unsigned()->nullable(false);
            $table->foreign('company_id')->references('id')->on('companies');
            $table->date('date')->nullable(false)->default(now());
            $table->integer('account_type')->nullable(false)->default(1)->unsigned();
            $table->decimal('current_amount', 18, 2)->nullable(false)->default(0)->signed();
            $table->decimal('1_to_30_amount', 18, 2)->nullable(false)->default(0)->signed();
            $table->decimal('31_to_60_amount', 18, 2)->nullable(false)->default(0)->signed();
            $table->decimal('61_to_90_amount', 18, 2)->nullable(false)->default(0)->signed();
            $table->decimal('over_90_amount', 18, 2)->nullable(false)->default(0)->signed();
            $table->decimal('total_amount', 18, 2)->nullable(false)->default(0)->signed();
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
        Schema::dropIfExists('aging_reports');
    }
};
