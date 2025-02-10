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
        schema::create('buyer', function (Blueprint $table) {
                $table->id('id_buyer');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email')->unique();
                $table->string('phone');
                $table->text('description');
                $table->string('company_name');
                $table->string('city');
                $table->string('state');
                $table->string('country');
                $table->string('zipcode');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
