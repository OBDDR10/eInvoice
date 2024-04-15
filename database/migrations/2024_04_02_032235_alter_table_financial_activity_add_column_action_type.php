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
        Schema::table('financial_activities', function (Blueprint $table) {
            $table->unsignedInteger('action_type')->nullable(false)->default(1)->unsigned()->after('activity_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financial_activities', function (Blueprint $table) {
            $table->dropColumn('action_type');
        });
    }
};
