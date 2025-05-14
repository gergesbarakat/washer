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
        Schema::table('couriers', function (Blueprint $table) {
            // Add the branch_id column and set up the foreign key
            $table->unsignedBigInteger('branch_id')->after('password');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('couriers', function (Blueprint $table) {
            // Drop the foreign key and column if rolling back
            $table->dropForeign(['branch_id']);
            $table->dropColumn('branch_id');
        });
    }
};
