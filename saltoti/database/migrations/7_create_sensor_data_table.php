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
        Schema::create('sensor_data', function (Blueprint $table) {
            $table->float("mertertek");
            $table->float("ertekvaltozas");

            $table->bigInteger("sensorID")->unsigned()->index();
            $table->foreign("sensorID")->references("ID")->on("sensors")->onDelete("cascade")->onUpdate("cascade");
            $table->datetime("mertido");
            $table->unique(["sensorID", "mertido"])->primary();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_data');
    }
};
