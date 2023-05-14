<?php
namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\Sensor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DBcontroller ;

class MainController extends Controller
{
    public function viewData()
    {
        $tmp = DB::table('uzems')->get();
        return View('view', ['data' => $tmp]);
    }
    public function getUsems()
    {
        $tmp = DB::table('uzems')->get();
        return View('main', ['data' => $tmp]);
    }

    public function uzem(Request $request)
    {

        $returnModel=app('App\Http\Controllers\DBcontroller')->uzem($request->id);
        if( $request->pagemethod==0)
        {
            return View('uzem', ['data' => $returnModel]);
        }
        else if($request->pagemethod==1)
        {
            return View('main_uzem', ['data' => $returnModel]);
        }

    }

    public function getkwhChart(Request $request)
    {

        $data=app('App\Http\Controllers\DBcontroller')->uzem($request->uzid);
        $jsCode = "
            var chart = AmCharts.makeChart('user-statistics', {
                'type': 'serial',
                'theme': 'light',
                'marginRight': 50,
                'marginLeft': 80,
                'autoMarginOffset': 20,
                'dataDateFormat': 'YYYY-MM-DD',
                'valueAxes': [{
                    'id': 'v1',
                    'axisAlpha': 0,
                    'position': 'left',
                    'ignoreAxisWidth': true,
                    'labelFunction': function(value) {
                        return  Math.round(value) + 'KWh';
                    }
                }],
                'balloon': {
                    'borderThickness': 1,
                    'shadowAlpha': 0
                },
                'graphs': [{
                    'id': 'g1',
                    'balloon': {
                        'drop': true,
                        'adjustBorderColor': false,
                        'color': '#ffffff',
                        'type': 'smoothedLine'
                    },
                    'fillAlphas': 0.2,
                    'bullet': 'round',
                    'bulletBorderAlpha': 1,
                    'bulletColor': '#FFFFFF',
                    'bulletSize': 5,
                    'hideBulletsCount': 50,
                    'lineThickness': 2,
                    'title': 'red line',
                    'useLineColorForBulletBorder': true,
                    'valueField': 'value',
                    'balloonText': '<span >[[value]]</span>'
                }],
                'chartCursor': {
                    'valueLineEnabled': true,
                    'valueLineBalloonEnabled': true,
                    'cursorAlpha': 0,
                    'zoomable': false,
                    'valueZoomable': true,
                    'valueLineAlpha': 0.5
                },
                'valueScrollbar': {
                    'autoGridCount': true,
                    'color': '#5E72F3',
                    'scrollbarHeight': 30
                },
                'categoryField': 'date',
                'categoryAxis': {
                    'parseDates': true,
                    'dashLength': 1,
                    'minorGridEnabled': true
                },
                'export': {
                    'enabled': false
                },
                'dataProvider': [
        ";
            foreach ( $data->kompresszorok as $kompresszor) {
                if ($kompresszor->kompresszorID==$request->kompid) {

                    foreach ($kompresszor->kwhSzenzor->mertAdatok as $adat) {
                        $jsCode=$jsCode."{
                            'date':'". $adat->mertIdo."',".
                            "'value':".$adat->mertErtek.
                            "},";
                            error_log('ja');
                    }
                    break;
                }
            }

        $jsCode=$jsCode."
            ]
            });

        ";

        return response()->json(['jsCode' => $jsCode]);

    }




}

?>
