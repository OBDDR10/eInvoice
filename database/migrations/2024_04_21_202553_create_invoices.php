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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->date('issued_date')->nullable(false)->default(now());
            $table->string('invoice_no', 255)->nullable(false);
            $table->decimal('total_amount', 16, 2)->nullable(false)->default('0')->unsigned();
            $table->unsignedBigInteger('client_company_id')->nullable();
            $table->string('client_name', 255)->nullable();
            $table->string('client_email', 255)->nullable();
            $table->string('client_contact_number', 255)->nullable();
            $table->string('client_pic_name', 255)->nullable();
            $table->string('client_address_1', 255)->nullable();
            $table->string('client_address_2', 255)->nullable();
            $table->string('client_address_3', 255)->nullable();
            $table->string('client_bank_name', 255)->nullable();
            $table->string('client_bank_account_no', 255)->nullable();
            $table->unsignedInteger('status')->nullable(false)->default(1);
            $table->bigInteger('emailed_by')->unsigned()->nullable();
            $table->foreign('emailed_by')->references('id')->on('users');
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->datetime('emailed_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
