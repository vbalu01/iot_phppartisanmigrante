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
        CREATE TRIGGER update_termelogep_kwhsensor
            AFTER INSERT ON sensor_data FOR EACH ROW
                BEGIN
                    DECLARE v_sum_divided_part FLOAT;
                    DECLARE v_active_count INT;
                    DECLARE v_divisor INT;

                    IF EXISTS (
                        SELECT * FROM `elszivos` WHERE `kwhSzenzor` = NEW.sensorID
                    ) THEN
                        SET v_active_count = (
                            SELECT COUNT(DISTINCT `termelogeps`.`ID`) FROM `termelogeps`
                            INNER JOIN `sensor_data`
                            ON `sensor_data`.`sensorID` = `termelogeps`.`kwhSzenzor`
                            WHERE `sensor_data`.`mertido` > DATE_SUB(NOW(), INTERVAL 1 HOUR)
                        );
                        IF v_active_count = 0 THEN
                            SET v_divisor = 1;
                        ELSE
                            SET v_divisor = v_active_count;
                        END IF;

                        SET v_sum_divided_part = (
                            SELECT SUM(`ertekvaltozas` / v_divisor) FROM `termelogeps`
                            INNER JOIN (
                                SELECT MAX(`sensor_data`.`mertido`) AS `lastMertIdo`, `termelogeps`.`ID` AS `tgId`
                                FROM `sensor_data`
                                INNER JOIN `termelogeps` ON `termelogeps`.`kwhSzenzor` = `sensor_data`.`sensorID`
                                GROUP BY `tgId`
                            ) AS `LatestSensorData`
                            ON `termelogeps`.`ID` = `LatestSensorData`.`tgId`
                            INNER JOIN `sensor_data`
                            ON `sensor_data`.`mertido` = `LatestSensorData`.`lastMertIdo` AND `sensor_data`.`sensorID` = `termelogeps`.`kwhSzenzor`
                            WHERE `termelogeps`.`ElszivoID` IN (
                                SELECT `ID` FROM `elszivos` WHERE `kwhSzenzor` = NEW.SensorId
                            )
                        );

                        UPDATE `sensor_data`
                        SET `mertertek` = `mertertek` + v_sum_divided_part
                        WHERE `mertido` = NEW.mertido AND `sensorID` IN (
                            SELECT `kwhSzenzor` FROM `termelogeps`
                            WHERE `ElszivoID` IN (
                                SELECT `ID` FROM `elszivos` WHERE `kwhSzenzor` = NEW.sensorID
                            )
                        );
                    END IF;
                END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trigger2');
    }
};
