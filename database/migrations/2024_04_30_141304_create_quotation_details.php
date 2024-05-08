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
        Schema::create('quotation_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('quotation_id')->nullable(false);
            $table->string('description', 999)->nullable(false);
            $table->unsignedInteger('quantity')->nullable(false)->default(1);
            $table->decimal('unit_price', 16, 2)->nullable(false)->default(0)->unsigned();
            $table->decimal('amount', 16, 2)->nullable(false)->default(0)->unsigned();
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
        Schema::dropIfExists('quotation_details');
    }
};
