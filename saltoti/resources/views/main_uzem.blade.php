@extends('index3')

@section("sidemenu")
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Kompresszorok</span></a>
            <ul class="collapse">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                @foreach ($data->kompresszorok as $kompresszor)
                    <li><a href="javascript:void(0)" onclick="ajaxsendTermelogep({{ $data->uzemId }},{{ $kompresszor->kompresszorID }})">{{ $kompresszor->kompresszorName }}</a></li>

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
                            <li><a href="/dash/elszivo/{{ $elszivo->elszivoId }}"><span>Összesített adatok</span></a> </li>
                           <li> <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Termelőgépek</span></a>
                            <ul class="collapse">
                                @foreach ($elszivo->termeloGepek as $termelogep)
                                    <li>
                                        <a href="/dash/elszivo/{{ $elszivo->elszivoId }}/{{  $termelogep->gepId }}">{{ $termelogep->gepName }}</a>

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
        function ajaxsendTermelogep(uzemid,kompresszorid) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                url: '/dash/kompresszor',
                method: 'POST',
                data: {
                    uzid: uzemid,
                    kompid: kompresszorid
                },
                success: function(response)
                {
                    console.log(response.jsCode);
                    if (!$( "#user-statistics" ).length) {
                        $( "#alma" ).prepend(
                        "<div class='col-lg-8 mt-5'>"+
                            "<div class='card'>"+
                               "<div class='card-body'>"+
                                    "<h4 class='header-title'>Fogyasztás</h4>"+
                                    "<div id='user-statistics'></div>"+
                                "</div>"+
                            "</div>"+
                        "</div>"
                        );
                    }

                    eval(response.jsCode);
                },
                error:function(result){
                    console.log("Hát itt valami nem jó: "+result);
                }
            });
        }
    </script>
@endsection


