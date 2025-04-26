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
        Schema::dropIfExists('places');
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->foreignId("area_id")->nullable()->references("id")->on("areas")->onDelete("set null");
            $table->string('title_ru');
            $table->string('title_kz')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_kz')->nullable();
            $table->string('image_url')->nullable();
            $table->text('geocode');
            $table->string('bg_color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
