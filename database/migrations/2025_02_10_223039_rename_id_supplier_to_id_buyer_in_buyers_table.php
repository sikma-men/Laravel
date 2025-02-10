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
        Schema::table('buyer', function (Blueprint $table) {
            $table->renameColumn('id supplier', 'id_buyer'); // Rename kolom
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->renameColumn('id_buyer', 'id_supplier'); // Rollback jika dibutuhkan
        });
    }
};
