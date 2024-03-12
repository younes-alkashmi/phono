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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('desc');
            $table->string('price');
            $table->string('battery');

            $table->string("proximity");
            $table->string("screen_size");
            $table->string("front_cam");
            $table->string("rear_cam");
            $table->string("rear_cam_no");
            $table->string("storage");
            $table->string("weight");
            $table->string("charger");
            $table->string("dimension");
            $table->string("resolution");
            $table->string("processor");
            $table->string("brand");
            $table->string("ram");
            $table->string('os');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
