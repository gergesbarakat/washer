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
            // Rename the columns according to the controller and blade
            $table->renameColumn('from_branch_id', 'branch_id'); // Renaming 'product_ids' to 'products'
            $table->renameColumn('user_id', 'hotel_id'); // Renaming 'product_ids' to 'products'

            // If needed, you can also adjust column types, but here we assume the correct column types were used in the initial migration.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            // Revert the changes if this migration is rolled back
            $table->renameColumn('branch_id', 'from_branch_id');
            $table->renameColumn('hotel_id', 'user_id');
        });
    }
};
