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
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('address_one');
            $table->string('city');
            $table->string('address_two')->nullable();
            $table->string('state');
            $table->string('country');
            $table->string('email');
            $table->string('zip');
            $table->string('phone');
            $table->string('instituition');
            $table->string('location');
            $table->string('contact');
            $table->string('phone2')->nullable();
            $table->string('donateBy');
            $table->string('memory');
            $table->string('instruction')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};
