<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('weather_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('location', 255);
            $table->string('description', 255)->nullable();
            $table->timestamp('timestamp');
            $table->unsignedInteger('temperature');
            $table->unsignedInteger('humidity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_data');
    }
};
