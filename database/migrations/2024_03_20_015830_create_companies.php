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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255)->nullable(false);
            $table->string('pic_name', 255)->nullable();
            $table->string('pic_contact_number', 255)->nullable();
            $table->string('checker', 255)->nullable();
            $table->string('checker_name', 255)->nullable();
            $table->string('checker_contact_number', 255)->nullable();
            $table->string('bank_name', 255)->nullable();
            $table->string('bank_account', 255)->nullable();
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
        Schema::dropIfExists('companies');
    }
};
