<?php
namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\Sensor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function viewData()
    {
        $tmp = DB::table('uzems')->get();
        return View('view', ['data' => $tmp]);
    }

    public function uzem(Request $request)
    {
        $returnModel = new UzemReturnModel();
        $returnModel->uzemId = DB::table('uzems')->select('ID')->where([['ID', '=', $request->id ]])->value('ID');
        $returnModel->uzemName = DB::table('uzems')->select('name')->where([['ID', '=', $request->id ]])->value('name');
        $termelogepek = DB::table('termelogeps')->where([['UzemID', '=', $request->id]])->get();
        $kompresszorok = DB::table('kompresszors')->where([['UzemID', '=', $request->id]])->get();

        $tmp = array();
        foreach($kompresszorok as $k){
            //Alap adatok
            $tmp_l = new Kompresszor_m();
            $tmp_l->kompresszorID = $k->ID;
            $tmp_l->kompresszorName = $k->name;

            //Kwh Szenzor
            $db_sensor = DB::table('sensors')->select('ID', 'name', 'mertekegyseg')->where([['ID', '=', $k->kwhSzenzor]])->first();
            $tmp_l->kwhSzenzor = new Sensor_m();
            $tmp_l->kwhSzenzor->sensorId = $db_sensor->ID;
            $tmp_l->kwhSzenzor->sensorName = $db_sensor->name;
            $tmp_l->kwhSzenzor->mertekEgyseg = $db_sensor->mertekegyseg;
            $tmp_l->kwhSzenzor->mertAdatok = array();

            foreach(DB::table('sensor_data')->select('mertertek', 'ertekvaltozas', 'mertIdo')->where([['sensorID', '=', $tmp_l->kwhSzenzor->sensorId]])->get() as $adat)
            {
                $tmp_adat = new MertAdat_m();
                $tmp_adat->mertIdo = $adat->mertIdo;
                $tmp_adat->mertErtek = $adat->mertertek;
                $tmp_adat->ertekValtozas = $adat->ertekvaltozas;
                array_push($tmp_l->kwhSzenzor->mertAdatok, $tmp_adat);
            }

            //Levego szenzor
            $db_sensor = DB::table('sensors')->select('ID', 'name', 'mertekegyseg')->where([['ID', '=', $k->levegoSzenzor]])->first();
            $tmp_l->levegoSzenzor = new Sensor_m();
            $tmp_l->levegoSzenzor->sensorId = $db_sensor->ID;
            $tmp_l->levegoSzenzor->sensorName = $db_sensor->name;
            $tmp_l->levegoSzenzor->mertekEgyseg = $db_sensor->mertekegyseg;
            $tmp_l->levegoSzenzor->mertAdatok = array();

            foreach(DB::table('sensor_data')->select('mertertek', 'ertekvaltozas', 'mertIdo')->where([['sensorID', '=', $tmp_l->kwhSzenzor->sensorId]])->get() as $adat)
            {
                $tmp_adat = new MertAdat_m();
                $tmp_adat->mertIdo = $adat->mertIdo;
                $tmp_adat->mertErtek = $adat->mertertek;
                $tmp_adat->ertekValtozas = $adat->ertekvaltozas;
                array_push($tmp_l->levegoSzenzor->mertAdatok, $tmp_adat);
            }

            array_push($tmp, $tmp_l);
        }
        $returnModel->kompresszorok = $tmp;

        $tmp = array();
        foreach($termelogepek as $g){
            $talalat = false;
            foreach($tmp as $elszivo){
                if($elszivo->elszivoId == $g->ElszivoID){
                    $talalat = true;
                    $tmp_l = new TermeloGep_m();
                    $tmp_l->gepId = $g->ID;
                    $tmp_l->gepName = $g->name;
                    $tmp_l->dbSzenzor = new Sensor_m();
                    $tmp_l->kwhSzenzor = new Sensor_m();

                    $db_darabszenzor = DB::table('sensors')->select('ID', 'name', 'mertekegyseg')->where([['ID', '=', $g->darabszenzor]])->first();
                    $db_kwhSzenzor = DB::table('sensors')->select('ID', 'name', 'mertekegyseg')->where([['ID', '=', $g->kwhSzenzor]])->first();

                    $tmp_l->dbSzenzor->sensorId = $db_darabszenzor->ID;
                    $tmp_l->dbSzenzor->sensorName = $db_darabszenzor->name;
                    $tmp_l->dbSzenzor->mertekEgyseg = $db_darabszenzor->mertekegyseg;
                    $tmp_l->dbSzenzor->mertAdatok = array();

                    foreach(DB::table('sensor_data')->select('mertertek', 'ertekvaltozas', 'mertIdo')->where([['sensorID', '=', $tmp_l->dbSzenzor->sensorId]])->get() as $adat)
                    {
                        $tmp_adat = new MertAdat_m();
                        $tmp_adat->mertIdo = $adat->mertIdo;
                        $tmp_adat->mertErtek = $adat->mertertek;
                        $tmp_adat->ertekValtozas = $adat->ertekvaltozas;
                        array_push($tmp_l->dbSzenzor->mertAdatok, $tmp_adat);
                    }

                    $tmp_l->kwhSzenzor->sensorId = $db_kwhSzenzor->ID;
                    $tmp_l->kwhSzenzor->sensorName = $db_kwhSzenzor->name;
                    $tmp_l->kwhSzenzor->mertekEgyseg = $db_kwhSzenzor->mertekegyseg;
                    $tmp_l->kwhSzenzor->mertAdatok = array();

                    foreach(DB::table('sensor_data')->select('mertertek', 'ertekvaltozas', 'mertIdo')->where([['sensorID', '=', $tmp_l->kwhSzenzor->sensorId]])->get() as $adat)
                    {
                        $tmp_adat = new MertAdat_m();
                        $tmp_adat->mertIdo = $adat->mertIdo;
                        $tmp_adat->mertErtek = $adat->mertertek;
                        $tmp_adat->ertekValtozas = $adat->ertekvaltozas;
                        array_push($tmp_l->kwhSzenzor->mertAdatok, $tmp_adat);
                    }

                    array_push($elszivo->termeloGepek, $tmp_l);
                    break;
                }
            }
            if(!$talalat){
                $elszivo = new Elszivo_m();
                $db_elszivo = DB::table('elszivos')->select('ID', 'name', 'kwhSzenzor')->where([['ID', '=', $g->ElszivoID]])->first();
                $elszivo->elszivoId = $db_elszivo->ID;
                $elszivo->elszivoName = $db_elszivo->name;
                $db_sensor = DB::table('sensors')->select('ID', 'name', 'mertekegyseg')->where([['ID', '=', $db_elszivo->kwhSzenzor]])->first();
                $elszivo->kwhSzenzor = new Sensor_m();
                $elszivo->kwhSzenzor->sensorId = $db_sensor->ID;
                $elszivo->kwhSzenzor->sensorName = $db_sensor->name;
                $elszivo->kwhSzenzor->mertekEgyseg = $db_sensor->mertekegyseg;
                $elszivo->kwhSzenzor->mertAdatok = array();

                foreach(DB::table('sensor_data')->select('mertertek', 'ertekvaltozas', 'mertIdo')->where([['sensorID', '=', $elszivo->kwhSzenzor->sensorId]])->get() as $adat)
                {
                    $tmp_adat = new MertAdat_m();
                    $tmp_adat->mertIdo = $adat->mertIdo;
                    $tmp_adat->mertErtek = $adat->mertertek;
                    $tmp_adat->ertekValtozas = $adat->ertekvaltozas;
                    array_push($elszivo->kwhSzenzor->mertAdatok, $tmp_adat);
                }

                $tmp_l = new TermeloGep_m();
                $tmp_l->gepId = $g->ID;
                $tmp_l->gepName = $g->name;
                $tmp_l->dbSzenzor = new Sensor_m();
                $tmp_l->kwhSzenzor = new Sensor_m();

                $db_darabszenzor = DB::table('sensors')->select('ID', 'name', 'mertekegyseg')->where([['ID', '=', $g->darabszenzor]])->first();
                $db_kwhSzenzor = DB::table('sensors')->select('ID', 'name', 'mertekegyseg')->where([['ID', '=', $g->kwhSzenzor]])->first();

                $tmp_l->dbSzenzor->sensorId = $db_darabszenzor->ID;
                $tmp_l->dbSzenzor->sensorName = $db_darabszenzor->name;
                $tmp_l->dbSzenzor->mertekEgyseg = $db_darabszenzor->mertekegyseg;
                $tmp_l->dbSzenzor->mertAdatok = array();

                foreach(DB::table('sensor_data')->select('mertertek', 'ertekvaltozas', 'mertIdo')->where([['sensorID', '=', $tmp_l->dbSzenzor->sensorId]])->get() as $adat)
                {
                    $tmp_adat = new MertAdat_m();
                    $tmp_adat->mertIdo = $adat->mertIdo;
                    $tmp_adat->mertErtek = $adat->mertertek;
                    $tmp_adat->ertekValtozas = $adat->ertekvaltozas;
                    array_push($tmp_l->dbSzenzor->mertAdatok, $tmp_adat);
                }

                $tmp_l->kwhSzenzor->sensorId = $db_kwhSzenzor->ID;
                $tmp_l->kwhSzenzor->sensorName = $db_kwhSzenzor->name;
                $tmp_l->kwhSzenzor->mertekEgyseg = $db_kwhSzenzor->mertekegyseg;
                $tmp_l->kwhSzenzor->mertAdatok = array();

                foreach(DB::table('sensor_data')->select('mertertek', 'ertekvaltozas', 'mertIdo')->where([['sensorID', '=', $tmp_l->kwhSzenzor->sensorId]])->get() as $adat)
                {
                    $tmp_adat = new MertAdat_m();
                    $tmp_adat->mertIdo = $adat->mertIdo;
                    $tmp_adat->mertErtek = $adat->mertertek;
                    $tmp_adat->ertekValtozas = $adat->ertekvaltozas;
                    array_push($tmp_l->kwhSzenzor->mertAdatok, $tmp_adat);
                }


                $elszivo->termeloGepek = array();
                array_push($elszivo->termeloGepek, $tmp_l);

                array_push($tmp, $elszivo);
            }



        }
        $returnModel->elszivok = $tmp;

        if( $request->pagemethod==0)
        {
            return View('uzem', ['data' => $returnModel]);
        }
        else if($request->pagemethod==1)
        {
            return View('stat', ['data' => $returnModel]);
        }

    }


    public function getUsems()
    {
        $tmp = DB::table('uzems')->get();
        return View('main', ['data' => $tmp]);
    }
}

?>
