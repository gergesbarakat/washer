<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('parcel_items', function (Blueprint $table) {
            if (!Schema::hasColumn('parcel_items', 'product_id')) {
                $table->unsignedBigInteger('product_id')->after('id');
            }
            if (!Schema::hasColumn('parcel_items', 'parcel_id')) {
                $table->unsignedBigInteger('parcel_id')->after('product_id');
            }
            if (!Schema::hasColumn('parcel_items', 'quantity')) {
                $table->integer('quantity')->default(1)->after('parcel_id');
            }
        });

        // Add foreign keys with custom names to avoid duplicates
        DB::statement("ALTER TABLE `parcel_items`
            ADD CONSTRAINT `fk_parcel_items_product` FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE");

        DB::statement("ALTER TABLE `parcel_items`
            ADD CONSTRAINT `fk_parcel_items_parcel` FOREIGN KEY (`parcel_id`) REFERENCES `parcels`(`id`) ON DELETE CASCADE");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcel_items', function (Blueprint $table) {
            $table->dropForeign('fk_parcel_items_product');
            $table->dropForeign('fk_parcel_items_parcel');

            if (Schema::hasColumn('parcel_items', 'product_id')) {
                $table->dropColumn('product_id');
            }
            if (Schema::hasColumn('parcel_items', 'parcel_id')) {
                $table->dropColumn('parcel_id');
            }
            if (Schema::hasColumn('parcel_items', 'quantity')) {
                $table->dropColumn('quantity');
            }
        });
    }
};
