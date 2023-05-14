<?php
    //dd($data);
?>

<style>
    .collapsible {
      background-color: #777;
      color: white;
      cursor: pointer;
      padding: 18px;
      width: 100%;
      border: none;
      text-align: left;
      outline: none;
      font-size: 15px;
    }
    
    .active, .collapsible:hover {
      background-color: #555;
    }
    
    .content {
      padding: 0 18px;
      display: none;
      overflow: hidden;
      background-color: #f1f1f1;
    }
</style>

<div>
    <h1>{{ $data->uzemName  }} (ID: {{ $data->uzemId }})</h1>

    <button type="button" class="collapsible">Kompresszorok</button>
    <div class="content">
        @foreach ($data->kompresszorok as $kompresszor)
            <button type="button" class="collapsible">{{ $kompresszor->kompresszorName }} (ID: {{ $kompresszor->kompresszorID }})</button>
            <div class="content">
                <button type="button" class="collapsible">Kwh Szenzor: {{ $kompresszor->kwhSzenzor->sensorName }} (ID: {{ $kompresszor->kwhSzenzor->sensorId }})</button>
                <div class="content">
                    <table style="border:1px solid black;">
                        <tr>
                            <th>
                                Időpont
                            </th>
                            <th>
                                Mért érték
                            </th>
                            <th>
                                Érték változás
                            </th>
                            <th>
                                Mértékegység
                            </th>
                        </tr>
                        
                        @foreach ($kompresszor->kwhSzenzor->mertAdatok as $adat)
                            <tr>
                                <td>
                                    {{ $adat->mertIdo }}
                                </td>
                                <td>
                                    {{ $adat->mertErtek }}
                                </td>
                                <td>
                                    {{ $adat->ertekValtozas }}
                                </td>
                                <td>
                                    {{ $kompresszor->kwhSzenzor->mertekEgyseg }}
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>

                <button type="button" class="collapsible">Levegő Szenzor: {{ $kompresszor->levegoSzenzor->sensorName }} (ID: {{ $kompresszor->levegoSzenzor->sensorId }})</button>
                <div class="content">
                    <table style="border:1px solid black;">
                        <tr>
                            <th>
                                Időpont
                            </th>
                            <th>
                                Mért érték
                            </th>
                            <th>
                                Érték változás
                            </th>
                            <th>
                                Mértékegység
                            </th>
                        </tr>
                        
                        @foreach ($kompresszor->levegoSzenzor->mertAdatok as $adat)
                            <tr>
                                <td>
                                    {{ $adat->mertIdo }}
                                </td>
                                <td>
                                    {{ $adat->mertErtek }}
                                </td>
                                <td>
                                    {{ $adat->ertekValtozas }}
                                </td>
                                <td>
                                    {{ $kompresszor->levegoSzenzor->mertekEgyseg }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        @endforeach
    </div>

    <hr>

    <button type="button" class="collapsible">Elszívók</button>
    <div class="content">
        @foreach ($data->elszivok as $elszivo)
            <button type="button" class="collapsible">{{ $elszivo->elszivoName }} (ID: {{ $elszivo->elszivoId }})</button>
            <div class="content">
                <button type="button" class="collapsible">Kwh szenzor: {{ $elszivo->kwhSzenzor->sensorName }} (ID: {{ $elszivo->kwhSzenzor->sensorId }})</button>
                <div class="content">
                    <table style="border:1px solid black;">
                        <tr>
                            <th>
                                Időpont
                            </th>
                            <th>
                                Mért érték
                            </th>
                            <th>
                                Érték változás
                            </th>
                            <th>
                                Mértékegység
                            </th>
                        </tr>
                        
                        @foreach ($elszivo->kwhSzenzor->mertAdatok as $adat)
                            <tr>
                                <td>
                                    {{ $adat->mertIdo }}
                                </td>
                                <td>
                                    {{ $adat->mertErtek }}
                                </td>
                                <td>
                                    {{ $adat->ertekValtozas }}
                                </td>
                                <td>
                                    {{ $elszivo->kwhSzenzor->mertekEgyseg }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <button type="button" class="collapsible">Termelőgépek</button>
                <div class="content">
                    @foreach ($elszivo->termeloGepek as $termelogep)
                        <button type="button" class="collapsible">{{ $termelogep->gepName }} (ID: {{ $termelogep->gepId }})</button>
                        <div class="content">
                            <button type="button" class="collapsible">DB szenzor: {{ $termelogep->dbSzenzor->sensorName }} (ID: {{ $termelogep->dbSzenzor->sensorId }})</button>
                            <div class="content">     
                                <table style="border:1px solid black;">
                                    <tr>
                                        <th>
                                            Időpont
                                        </th>
                                        <th>
                                            Mért érték
                                        </th>
                                        <th>
                                            Érték változás
                                        </th>
                                        <th>
                                            Mértékegység
                                        </th>
                                    </tr>
                                    
                                    @foreach ($termelogep->dbSzenzor->mertAdatok as $adat)
                                        <tr>
                                            <td>
                                                {{ $adat->mertIdo }}
                                            </td>
                                            <td>
                                                {{ $adat->mertErtek }}
                                            </td>
                                            <td>
                                                {{ $adat->ertekValtozas }}
                                            </td>
                                            <td>
                                                {{ $termelogep->dbSzenzor->mertekEgyseg }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>

                            <button type="button" class="collapsible">Kwh szenzor: {{ $termelogep->kwhSzenzor->sensorName }} (ID: {{ $termelogep->kwhSzenzor->sensorId }})</button>
                            <div class="content">     
                                <table style="border:1px solid black;">
                                    <tr>
                                        <th>
                                            Időpont
                                        </th>
                                        <th>
                                            Mért érték
                                        </th>
                                        <th>
                                            Érték változás
                                        </th>
                                        <th>
                                            Mértékegység
                                        </th>
                                    </tr>
                                    
                                    @foreach ($termelogep->kwhSzenzor->mertAdatok as $adat)
                                        <tr>
                                            <td>
                                                {{ $adat->mertIdo }}
                                            </td>
                                            <td>
                                                {{ $adat->mertErtek }}
                                            </td>
                                            <td>
                                                {{ $adat->ertekValtozas }}
                                            </td>
                                            <td>
                                                {{ $termelogep->kwhSzenzor->mertekEgyseg }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>   
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;
    
    for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
          content.style.display = "none";
        } else {
          content.style.display = "block";
        }
      });
    }
</script>