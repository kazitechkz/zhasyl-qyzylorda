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
        Schema::create('bushes', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete("set null");
            $table->foreignId('type_id')->nullable()->references('id')->on('types')->onDelete("set null");
            $table->foreignId('breed_id')->nullable()->references('id')->on('breeds')->onDelete("set null");
            $table->foreignId('sanitary_id')->nullable()->references('id')->on('sanitaries')->onDelete("set null");
            $table->foreignId('place_id')->nullable()->references('id')->on('places')->onDelete("set null");
            $table->foreignId('area_id')->nullable()->references('id')->on('areas')->onDelete("set null");
            $table->string('image_url')->nullable();
            $table->text('geocode');
            $table->string('length');
            $table->string('height');
            $table->string('width');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bushes');
    }
};
