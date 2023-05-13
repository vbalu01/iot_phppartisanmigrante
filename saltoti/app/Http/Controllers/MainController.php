<?php
namespace App\Http\Controllers;

use App\Models\categories;
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

    public function uzem($id)
    {
        $returnModel = new UzemReturnModel();
        $returnModel->uzemId = DB::table('uzems')->select('ID')->where([['ID', '=', $id ]])->value('ID');
        $returnModel->uzemName = DB::table('uzems')->select('name')->where([['ID', '=', $id ]])->value('name');
        $termelogepek = DB::table('termelogeps')->where([['UzemID', '=', $id]])->get();
        $kompresszorok = DB::table('kompresszors')->where([['UzemID', '=', $id]])->get();

        $tmp = array();
        foreach($kompresszorok as $k){
            $tmp_l = new Kompresszor_m();
            $tmp_l->kompresszorID = $k->ID;
            $tmp_l->kompresszorName = $k->name;
            array_push($tmp, $tmp_l);
        }
        $returnModel->kompresszorok = $tmp;

        $tmp = array();
        foreach($termelogepek as $g){
            $tmp_l = new TermeloGep_m();
            $tmp_l->gepId = $g->ID;
            $tmp_l->gepName = $g->name;

        }
        $returnModel->elszivok = $tmp;

        return View('uzem', ['data' => $returnModel]);
    }
}

?>