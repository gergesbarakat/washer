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
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // hotel
            $table->unsignedBigInteger('courier_id')->nullable();
            $table->unsignedBigInteger('from_branch_id');
            $table->unsignedBigInteger('to_branch_id')->nullable();
            $table->string('sender_name');
            $table->string('sender_address');
            $table->string('sender_contact');
            $table->string('recipient_name');
            $table->string('recipient_address');
            $table->string('recipient_contact');
            $table->boolean('type')->default(1); // 1 = Deliver, 0 = Pickup
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('courier_id')->references('id')->on('couriers')->onDelete('set null');
            $table->foreign('from_branch_id')->references('id')->on('branches');
            $table->foreign('to_branch_id')->references('id')->on('branches');
        });
            }

    public function down(): void
    {
        Schema::dropIfExists('parcels');
    }
};
