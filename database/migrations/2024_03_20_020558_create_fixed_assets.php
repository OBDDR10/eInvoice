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
        Schema::create('fixed_assets', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('company_id')->unsigned()->nullable(false);
            $table->foreign('company_id')->references('id')->on('companies');
            $table->string('name', 255)->nullable(false);
            $table->date('purchase_date')->nullable(false)->default(now());
            $table->decimal('purchase_price', 18, 2)->nullable(false)->default(0)->unsigned();
            $table->decimal('depreciation', 18, 2)->nullable(false)->default(0)->unsigned();
            $table->decimal('net_book_value', 18, 2)->nullable(false)->default(0)->signed();
            $table->integer('useful_life')->nullable()->signed();
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
        Schema::dropIfExists('fixed_assets');
    }
};
