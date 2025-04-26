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
        Schema::create('markers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete("set null");
            $table->foreignId('type_id')->nullable()->references('id')->on('types')->onDelete("set null");
            $table->foreignId('event_id')->nullable()->references('id')->on('events')->onDelete("set null");
            $table->foreignId('sanitary_id')->nullable()->references('id')->on('sanitaries')->onDelete("set null");
            $table->foreignId('category_id')->nullable()->references('id')->on('categories')->onDelete("set null");
            $table->foreignId('breed_id')->nullable()->references('id')->on('breeds')->onDelete("set null");
            $table->foreignId('status_id')->nullable()->references('id')->on('statuses')->onDelete("set null");
            $table->foreignId('place_id')->nullable()->references('id')->on('places')->onDelete("set null");
            $table->foreignId('area_id')->nullable()->references('id')->on('areas')->onDelete("set null");
            $table->text('geocode');
            $table->point("point")->nullable();
            $table->string('image_url')->nullable();
            $table->string('age')->nullable();
            $table->string('height');
            $table->string('diameter');
            $table->string('landing_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markers');
    }
};
