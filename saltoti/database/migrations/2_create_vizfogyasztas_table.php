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
        Schema::create('vizfogyasztas', function (Blueprint $table) {
            $table->id("ID");
            $table->string("name",55);
            $table->bigInteger('SensorID')->unsigned()->index();
            $table->foreign('SensorID')->references('ID')->on('sensors')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vizfogyasztas');
    }
};
