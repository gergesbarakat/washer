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
        Schema::table('parcels', function (Blueprint $table) {
            // Make the relevant columns nullable
            $table->string('sender_name')->nullable()->change();
            $table->string('sender_address')->nullable()->change();
            $table->string('sender_contact')->nullable()->change();
            $table->string('recipient_name')->nullable()->change();
            $table->string('recipient_address')->nullable()->change();
            $table->string('recipient_contact')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            // Revert the columns back to non-nullable if rolling back the migration
            $table->string('sender_name')->nullable(false)->change();
            $table->string('sender_address')->nullable(false)->change();
            $table->string('sender_contact')->nullable(false)->change();
            $table->string('recipient_name')->nullable(false)->change();
            $table->string('recipient_address')->nullable(false)->change();
            $table->string('recipient_contact')->nullable(false)->change();
        });
    }
};
