<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        CREATE TRIGGER MertErtekValtozas
        BEFORE INSERT ON sensor_data FOR EACH ROW
        BEGIN
            IF EXISTS (SELECT mertertek from sensor_data WHERE sensor_data.sensorID = NEW.sensorID ORDER BY sensor_data.mertido DESC LIMIT 1) THEN
                SELECT mertertek from sensor_data WHERE sensor_data.sensorID = NEW.sensorID ORDER BY sensor_data.mertido DESC LIMIT 1 INTO @tmp;
                SET NEW.ertekvaltozas = NEW.mertertek - @tmp;
            ELSE
                SET NEW.ertekvaltozas = NEW.mertertek;
            END IF;
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trigger');
    }
};
