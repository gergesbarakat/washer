<?php

 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->boolean('status')->default(true)->after('name');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('status')->default(true)->after('email');
        });

        Schema::table('couriers', function (Blueprint $table) {
            $table->boolean('status')->default(true)->after('name');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->boolean('status')->default(true)->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('couriers', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
