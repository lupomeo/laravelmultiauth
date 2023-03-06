@extends('layouts.appa')
  
@section('content')
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    

            

<div >
    <div class="col-12 col-sm-6 col-xl-4 mb-4" style="float:left;display:block;">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0"> Benvenuto</h2>
                            <h3 class="fw-extrabold mb-2">{{ Auth::user()->name }}</h3>
                        </div>
                        <div class="small d-flex mt-1"> 
                            Oggi è: @php 
                            setlocale(LC_TIME, 'ita', 'it_IT.utf8');
                            $data = strftime("%A, %d %B %Y");
                            echo ($data); 
                            @endphp
                        </div> 
                        <div class="small d-flex mt-1">                               
                            <div>Sono le ore: @php echo(date('H:i:s') ); @endphp</div>
                            <br>
                        </div>
                    </div>
                    <div class="card-body" style="margin: 0 auto; text-align: center;">
                        <img><img src="assets/img/Logo-1.png"></img>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-4" style="float:left;display:block;">
        <div class="card border-0 shadow">
            <div class="col-12 px-0">
                <div class="card border-0 shadow" style="margin: 0 auto; text-align: center;">
                    <div class="card-body style="margin: 0 auto; text-align: center;">
                    <h2 class="fs-5 fw-bold mb-1">Statistiche Database</h2>
                        <div class="small d-flex mt-1">
                            Utenti registrati:  {{{ $utotal }}}
                        </div>
                        <div class="card-body" style="margin: 0 auto; text-align: center;">
                        <img><img src="assets/img/illustrations/statistiche.jpg"></img>
                        </div>         
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-4 mb-4" style="float:right;display:block;">
        <div class="card border-0 shadow">
            <div class="col-12 px-0">
                <div class="card border-0 shadow">
                    <div class="card-body" style="margin: 0 auto; text-align: center;">
                        
                        <h2 class="fs-5 fw-bold mb-1">Monitoraggio Utenti</h2>
                        
                        <div class="small d-flex mt-1">
                            Ultimo utente registrato:  {{{ $lastu }}}
                        </div>
                        <br>
                        <div class="card-body" style="margin: 0 auto; text-align: center;">
                        <img><img src="assets/img/illustrations/analisi.jpg"></img>
                        <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div style="clear:both;">
    <div class="row">
        <div class="card border-0 shadow">
            <div class="col-12 px-0">
                <div >
                    <div class="card-body" style="margin: 0 auto; text-align: center;">
                    <div id="chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
            var options = {
          series: [{
            name: "Utenti registrati",
            data: [{{ $day[1] }}, {{ $day[2] }}, {{ $day[3] }}, {{ $day[4] }}, {{ $day[5] }}, {{ $day[6] }}, {{ $day[7] }}, {{ $day[8] }}, {{ $day[9] }},{{ $day[10] }}, {{ $day[11] }}, {{ $day[12] }}, {{ $day[13] }}, {{ $day[14] }}, {{ $day[15] }}, {{ $day[16] }}, {{ $day[17] }}, {{ $day[18] }},{{ $day[19] }}, {{ $day[20] }}, {{ $day[21] }}, {{ $day[22] }}, {{ $day[23] }}, {{ $day[24] }}, {{ $day[25] }}, {{ $day[26] }}, {{ $day[27] }},{{ $day[28] }}, {{ $day[29] }}, {{ $day[30] }}, {{ $day[31] }} ]
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        title: {
          text: 'Utenti registrati nell\'ultimo mese',
          align: 'left'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9','10', '11', '12', '13', '14', '15', '16', '17', '18', '19','20', '21', '22', '23', '24', '25', '26', '27', '28','29', '30', '31' ],
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();            

        });
    </script>
@endsection
