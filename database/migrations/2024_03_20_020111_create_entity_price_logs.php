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
        Schema::create('entity_price_logs', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('financial_entity_id')->unsigned()->nullable(false);
            $table->foreign('financial_entity_id')->references('id')->on('financial_entities');
            $table->date('date')->nullable(false)->default(now());
            $table->decimal('price', 18, 2)->nullable(false)->default(0)->signed();
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
        Schema::dropIfExists('entity_price_logs');
    }
};
