<?php

namespace App\Http\Controllers;

class UzemReturnModel{
    public $uzemId;
    public $uzemName;
    public $kompresszorok;
    public $elszivok;
}

class Kompresszor_m{
    public $kompresszorID;
    public $kompresszorName;
    public $kwhSzenzor;
    public $levegoSzenzor;
}

class Elszivo_m{
    public $elszivoId;
    public $elszivoName;
    public $termeloGepek;
}

class TermeloGep_m{
    public $gepId;
    public $gepName;
    public $dbSzenzor;
    public $kwhSzenzor;
}

class MertAdat_m{
    public $mertErtek;
    public $ertekValtozas;
    public $sensor;
    public $mertIdo;
}

class Sensor_m{
    public $sensorId;
    public $sensorName;
    public $mertekEgyseg;
    public $mertAdatok;
}
?>