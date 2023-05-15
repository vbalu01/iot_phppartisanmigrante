@extends('index3')

@section("sidemenu")
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Kompresszorok</span></a>
            <ul class="collapse">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                @foreach ($data->kompresszorok as $kompresszor)
                    <li><a href="javascript:void(0)" onclick="ajaxsendKompresszor({{ $data->uzemId }},{{ $kompresszor->kompresszorID }})">{{ $kompresszor->kompresszorName }}</a></li>

                @endforeach


            </ul>
        </li>
        <li>
            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Elszívók</span></a>
            <ul class="collapse">
                @foreach ($data->elszivok as $elszivo)
                    <li>
                        <a href="javascript:void(0)"><i class="ti-dashboard"></i><span>{{ $elszivo->elszivoName }}</span></a>
                        <ul class="collapse">
                            <li><a href="javascript:void(0)" onclick="ajaxsendElszivo({{ $data->uzemId }},{{  $elszivo->elszivoId }})"><span>Összesített adatok</span></a> </li>
                           <li> <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Termelőgépek</span></a>
                            <ul class="collapse">
                                @foreach ($elszivo->termeloGepek as $termelogep)
                                    <li>
                                        <a href="javascript:void(0)" onclick="ajaxsendTermelo({{ $data->uzemId }},{{  $elszivo->elszivoId }},{{   $termelogep->gepId }})">{{ $termelogep->gepName }}</a>

                                    </li>
                                @endforeach
                            </ul>
                           </li>
                        </ul>
                    </li>

                @endforeach


            </ul>
        </li>
    </ul>
@endsection
@section('moneystatiscitJS')

@endsection
@section("js")
    <script>
        function ajaxsendKompresszor(uzemid,kompresszorid) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                url: '/dash/kompresszor',
                method: 'POST',
                data: {
                    type:0,
                    uzid: uzemid,
                    kompid: kompresszorid
                },
                success: function(response)
                {
                    console.log(response);
                    if (!$( "#cha1" ).length) {
                        $( "#alma" ).prepend(
                        "<div id='cha1' class='col-lg-8 mt-5'>"+
                            "<div class='card'>"+
                               "<div class='card-body'>"+
                                    "<h4 class='header-title'>Fogyasztás</h4>"+
                                    "<div  id='user-statistics2' class='ustat'></div>"+
                                "</div>"+
                            "</div>"+
                        "</div>"
                        );
                    }
                    if ($( "#cha2" ).length) {
                        $( "#cha2" ).remove();
                    }
                    if (!$( "#cha2" ).length) {
                        $( "#alma" ).prepend(
                        "<div id='cha2' class='col-lg-8 mt-5'>"+
                            "<div class='card'>"+
                               "<div class='card-body'>"+
                                    "<h4 class='header-title'>Légtermelés</h4>"+
                                    "<div class='ustat' id='user-statistics3'></div>"+
                                "</div>"+
                            "</div>"+
                        "</div>"
                        );
                    }
                    eval(response.kwhJS.original.jsCode);
                    eval(response.airJS.original.jsCode);
                },
                error:function(result){
                    console.log("Hát itt valami nem jó: "+result);
                }
            });
        }

        function ajaxsendElszivo(uzemid,elszivoid) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                url: '/dash/elszivo',
                method: 'POST',
                data: {
                    type:1,
                    uzid: uzemid,
                    elszid: elszivoid
                },
                success: function(response)
                {
                    console.log(response);
                    if (!$( "#cha1" ).length) {
                        $( "#alma" ).prepend(
                        "<div id='cha1' class='col-lg-8 mt-5'>"+
                            "<div class='card'>"+
                               "<div class='card-body'>"+
                                    "<h4 class='header-title'>Fogyasztás</h4>"+
                                    "<div  id='user-statistics2' class='ustat'></div>"+
                                "</div>"+
                            "</div>"+
                        "</div>"
                        );
                    }
                    if ($( "#cha2" ).length) {
                        $( "#cha2" ).remove();
                    }

                    eval( response.jsCode);
                },
                error:function(result){
                    console.log("Hát itt valami nem jó: "+result);
                }
            });
        }

        function ajaxsendTermelo(uzemid,elszivoid,termgepid) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                url: '/dash/termelogep',
                method: 'POST',
                data: {
                    type:2,
                    uzid: uzemid,
                    elszid: elszivoid,
                    terid: termgepid
                },
                success: function(response)
                {
                    console.log(response);
                    if (!$( "#cha1" ).length) {
                        $( "#alma" ).prepend(
                        "<div id='cha1' class='col-lg-8 mt-5'>"+
                            "<div class='card'>"+
                               "<div class='card-body'>"+
                                    "<h4 class='header-title'>Fogyasztás</h4>"+
                                    "<div  id='user-statistics2' class='ustat'></div>"+
                                "</div>"+
                            "</div>"+
                        "</div>"
                        );
                    }
                    if ($( "#cha2" ).length) {
                        $( "#cha2" ).remove();
                    }
                    if (!$( "#cha2" ).length) {
                        $( "#alma" ).prepend(
                        "<div id='cha2' class='col-lg-8 mt-5'>"+
                            "<div class='card'>"+
                               "<div class='card-body'>"+
                                    "<h4 class='header-title'>Gyártott darab</h4>"+
                                    "<div class='ustat' id='user-statistics3'></div>"+
                                "</div>"+
                            "</div>"+
                        "</div>"
                        );
                    }

                    eval(response.kwhJS.original.jsCode);
                    eval(response.dbJS.original.jsCode);
                },
                error:function(result){
                    console.log("Hát itt valami nem jó: "+result);
                }
            });
        }
    </script>
@endsection


