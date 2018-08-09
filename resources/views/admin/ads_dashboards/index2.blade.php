@extends('layouts.adashboard')

@push('pagestyle')
<!-- Styles -->
<style>
#chartdiv {
	width: 100%;
	height: 500px;
}
</style>

@endpush

@section('content')
    <h3 class="page-title">@lang('global.ads-dashboard.title')</h3>
    
    <p>
        {{ trans('global.app_custom_controller_index') }} 
    </p>


    <!-- HTML -->
<div id="chartdiv"></div>


@stop

@push('topscripts')
<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
	"theme": "light",
    "legend": {
        "horizontalGap": 10,
        "maxColumns": 1,
        "position": "right",
		"useGraphSettings": true,
		"markerSize": 10
    },
    "dataProvider": [
{"time":20180601001001.106000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-001001","duration":14.900},
{"time":20180601001016.192000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-001016","duration":29.725},
{"time":20180601001146.304000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-001146","duration":14.950},
{"time":20180601001200.304000,"channel":"FOODHD","clip":"SharpStart","duration":483.062},
{"time":20180601002004.316000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-002004","duration":14.850},
{"time":20180601002019.377000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-002019","duration":14.850},
{"time":20180601002034.413000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-002034","duration":29.550},
{"time":20180601002104.358000,"channel":"FOODHD","clip":"AD_FOODHD_20180305-181413","duration":14.825},
{"time":20180601002134.428000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-002134","duration":29.675},
{"time":20180601002203.428000,"channel":"FOODHD","clip":"SharpStart","duration":670.184},
{"time":20180601003314.271000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-003314","duration":14.625},
{"time":20180601003329.155000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-003329","duration":14.825},
{"time":20180601003344.166000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-003344","duration":29.700},
{"time":20180601003444.133000,"channel":"FOODHD","clip":"AD_FOODHD_20180529-020923","duration":15.000},
{"time":20180601003459.133000,"channel":"FOODHD","clip":"SharpStart","duration":288.179},
{"time":20180601003947.312000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-003947","duration":29.800},
{"time":20180601004017.307000,"channel":"FOODHD","clip":"AD_FOODHD_20180528-053408","duration":15.000},
{"time":20180601004032.243000,"channel":"FOODHD","clip":"AD_FOODHD_20180430-203237","duration":15.000},
{"time":20180601004047.243000,"channel":"FOODHD","clip":"SharpStart","duration":443.182},
{"time":20180601004810.520000,"channel":"FOODHD","clip":"AD_FOODHD_20180518-012022","duration":14.850},
{"time":20180601004825.656000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-004825","duration":29.575},
{"time":20180601004855.551000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":29.970},
{"time":20180601004925.546000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-004925","duration":29.675},
{"time":20180601005025.588000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-005025","duration":29.725},
{"time":20180601005055.608000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-005055","duration":14.875},
{"time":20180601005140.614000,"channel":"FOODHD","clip":"AD_FOODHD_20180521-065713","duration":15.000},
{"time":20180601005155.675000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-005155","duration":14.975},
{"time":20180601005209.675000,"channel":"FOODHD","clip":"SharpStart","duration":1078.382},
{"time":20180601011009.032000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-011009","duration":14.925},
{"time":20180601011024.143000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":60.040},
{"time":20180601011124.208000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-011124","duration":29.675},
{"time":20180601011154.180000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":30.070},
{"time":20180601011224.325000,"channel":"FOODHD","clip":"AD_FOODHD_20180529-020923","duration":14.925},
{"time":20180601011238.325000,"channel":"FOODHD","clip":"SharpStart","duration":528.195},
{"time":20180601012127.445000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-012127","duration":14.700},
{"time":20180601012142.281000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":60.115},
{"time":20180601012227.237000,"channel":"FOODHD","clip":"AD_FOODHD_20180523-221205","duration":15.000},
{"time":20180601012242.421000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-012242","duration":14.750},
{"time":20180601012257.507000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-012257","duration":29.550},
{"time":20180601012357.524000,"channel":"FOODHD","clip":"AD_FOODHD_20180517-224934","duration":15.000},
{"time":20180601012412.524000,"channel":"FOODHD","clip":"SharpStart","duration":491.429},
{"time":20180601013223.953000,"channel":"FOODHD","clip":"AD_FOODHD_20180518-012022","duration":15.000},
{"time":20180601013239.164000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-013239","duration":29.625},
{"time":20180601013309.134000,"channel":"FOODHD","clip":"AD_FOODHD_20180520-073932","duration":15.000},
{"time":20180601013324.134000,"channel":"FOODHD","clip":"SharpStart","duration":429.141},
{"time":20180601014033.275000,"channel":"FOODHD","clip":"AD_FOODHD_20180504-060911","duration":15.000},
{"time":20180601014148.578000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-014148","duration":14.750},
{"time":20180601014233.334000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-014233","duration":14.950},
{"time":20180601014247.334000,"channel":"FOODHD","clip":"SharpStart","duration":311.232},
{"time":20180601014759.516000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-014759","duration":14.825},
{"time":20180601014844.720000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-014844","duration":14.600},
{"time":20180601014859.456000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":45.181},
{"time":20180601014944.662000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-014944","duration":14.925},
{"time":20180601014959.623000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-014959","duration":14.875},
{"time":20180601015044.729000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-015044","duration":14.825},
{"time":20180601015129.785000,"channel":"FOODHD","clip":"AD_FOODHD_20180517-224934","duration":15.000},
{"time":20180601015203.780000,"channel":"FOODHD","clip":"SharpStart","duration":1490.484},
{"time":20180601021655.320000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-021655","duration":29.625},
{"time":20180601021725.365000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-021725","duration":14.850},
{"time":20180601021825.332000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-021825","duration":14.900},
{"time":20180601021855.502000,"channel":"FOODHD","clip":"AD_FOODHD_20180525-012349","duration":14.800},
{"time":20180601021910.438000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":44.906},
{"time":20180601021940.458000,"channel":"FOODHD","clip":"AD_FOODHD_20180521-065713","duration":15.000},
{"time":20180601021959.369000,"channel":"FOODHD","clip":"SharpStart","duration":285.966},
{"time":20180601022446.160000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-022446","duration":29.550},
{"time":20180601022601.088000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-022601","duration":14.925},
{"time":20180601022701.328000,"channel":"FOODHD","clip":"AD_FOODHD_20180518-012022","duration":15.000},
{"time":20180601022716.328000,"channel":"FOODHD","clip":"SharpStart","duration":3030.972},
{"time":20180601031748.502000,"channel":"FOODHD","clip":"AD_FOODHD_20180530-141719","duration":14.850},
{"time":20180601031803.638000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-031803","duration":14.650},
{"time":20180601031818.424000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":60.115},
{"time":20180601031918.564000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-031918","duration":29.750},
{"time":20180601031948.611000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":30.045},
{"time":20180601032022.656000,"channel":"FOODHD","clip":"SharpStart","duration":365.313},
{"time":20180601032628.269000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-032628","duration":14.800},
{"time":20180601032643.205000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":30.070},
{"time":20180601032713.300000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-032713","duration":14.900},
{"time":20180601032727.300000,"channel":"FOODHD","clip":"SharpStart","duration":708.119},
{"time":20180601033916.319000,"channel":"FOODHD","clip":"AD_FOODHD_20180523-221205","duration":15.000},
{"time":20180601033931.455000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":45.006},
{"time":20180601034016.486000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-034016","duration":13.275},
{"time":20180601034029.486000,"channel":"FOODHD","clip":"SharpStart","duration":380.666},
{"time":20180601034650.427000,"channel":"FOODHD","clip":"AD_FOODHD_20180520-073932","duration":15.000},
{"time":20180601034750.592000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-034750","duration":14.775},
{"time":20180601034850.559000,"channel":"FOODHD","clip":"AD_FOODHD_20180430-203237","duration":14.850},
{"time":20180601034905.545000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":45.106},
{"time":20180601034950.776000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-034950","duration":19.175},
{"time":20180601035009.685000,"channel":"FOODHD","clip":"SharpStart","duration":1906.872},
{"time":20180601042157.769000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-042157","duration":29.450},
{"time":20180601042227.539000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":19.855},
{"time":20180601042247.419000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-042247","duration":10.075},
{"time":20180601042327.706000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-042327","duration":29.775},
{"time":20180601042431.771000,"channel":"FOODHD","clip":"SharpStart","duration":915.367},
{"time":20180601043948.148000,"channel":"FOODHD","clip":"AD_FOODHD_20180518-012022","duration":15.000},
{"time":20180601044033.254000,"channel":"FOODHD","clip":"AD_FOODHD_20180504-060911","duration":15.000},
{"time":20180601044048.440000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-044048","duration":14.750},
{"time":20180601044133.521000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-044133","duration":14.675},
{"time":20180601044148.430000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-044148","duration":14.900},
{"time":20180601044233.311000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-044233","duration":15.000},
{"time":20180601044248.311000,"channel":"FOODHD","clip":"SharpStart","duration":430.257},
{"time":20180601044959.625000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-044959","duration":14.850},
{"time":20180601045044.756000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-045044","duration":14.775},
{"time":20180601045129.937000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-045129","duration":34.175},
{"time":20180601045203.937000,"channel":"FOODHD","clip":"SharpStart","duration":937.052},
{"time":20180601050741.164000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-050741","duration":29.600},
{"time":20180601050841.131000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-050841","duration":14.875},
{"time":20180601050856.142000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-050856","duration":11.975},
{"time":20180601050907.142000,"channel":"FOODHD","clip":"SharpStart","duration":497.177},
{"time":20180601051725.294000,"channel":"FOODHD","clip":"AD_FOODHD_20180520-073932","duration":14.900},
{"time":20180601051740.330000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":15.059},
{"time":20180601051755.414000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-051755","duration":23.650},
{"time":20180601051855.456000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-051855","duration":14.950},
{"time":20180601051910.542000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":45.056},
{"time":20180601051940.437000,"channel":"FOODHD","clip":"AD_FOODHD_20180521-065713","duration":15.000},
{"time":20180601051959.623000,"channel":"FOODHD","clip":"SharpStart","duration":316.286},
{"time":20180601052516.109000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-052516","duration":14.875},
{"time":20180601052631.160000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-052631","duration":29.825},
{"time":20180601052701.332000,"channel":"FOODHD","clip":"AD_FOODHD_20180509-175437","duration":14.725},
{"time":20180601052715.332000,"channel":"FOODHD","clip":"SharpStart","duration":2530.138},
{"time":20180601060926.371000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-060926","duration":14.850},
{"time":20180601060941.457000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-060941","duration":29.650},
{"time":20180601061011.302000,"channel":"FOODHD","clip":"AD_FOODHD_20180518-012022","duration":15.000},
{"time":20180601061026.302000,"channel":"FOODHD","clip":"SharpStart","duration":442.129},
{"time":20180601061748.431000,"channel":"FOODHD","clip":"AD_FOODHD_20180530-141719","duration":15.000},
{"time":20180601061803.615000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-061803","duration":14.775},
{"time":20180601061903.507000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-061903","duration":14.900},
{"time":20180601061918.543000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":30.120},
{"time":20180601061948.688000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-061948","duration":33.975},
{"time":20180601062021.688000,"channel":"FOODHD","clip":"SharpStart","duration":350.574},
{"time":20180601062613.237000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-062613","duration":14.850},
{"time":20180601062628.248000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-062628","duration":14.825},
{"time":20180601062643.209000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-062643","duration":29.800},
{"time":20180601062712.209000,"channel":"FOODHD","clip":"SharpStart","duration":1298.220},
{"time":20180601064850.438000,"channel":"FOODHD","clip":"AD_FOODHD_20180430-203237","duration":15.000},
{"time":20180601064905.672000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-064905","duration":29.575},
{"time":20180601064935.569000,"channel":"FOODHD","clip":"AD_FOODHD_20180521-065713","duration":15.000},
{"time":20180601064950.653000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-064950","duration":19.250},
{"time":20180601065009.653000,"channel":"FOODHD","clip":"SharpStart","duration":1205.555},
{"time":20180601071016.357000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-071016","duration":29.725},
{"time":20180601071101.288000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-071101","duration":14.900},
{"time":20180601071116.422000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-071116","duration":26.850},
{"time":20180601071142.422000,"channel":"FOODHD","clip":"SharpStart","duration":1200.288},
{"time":20180601073144.149000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-073144","duration":29.650},
{"time":20180601073214.119000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":59.967},
{"time":20180601073314.111000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-073314","duration":14.900},
{"time":20180601073329.147000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":60.165},
{"time":20180601073413.953000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-073413","duration":15.100},
{"time":20180601073429.362000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-073429","duration":14.800},
{"time":20180601073444.223000,"channel":"FOODHD","clip":"AD_FOODHD_20180529-020923","duration":15.000},
{"time":20180601073459.223000,"channel":"FOODHD","clip":"SharpStart","duration":318.149},
{"time":20180601074017.372000,"channel":"FOODHD","clip":"AD_FOODHD_20180528-053408","duration":15.000},
{"time":20180601074032.383000,"channel":"FOODHD","clip":"AD_FOODHD_20180430-203237","duration":14.850},
{"time":20180601074047.494000,"channel":"FOODHD","clip":"AD_FOODHD_20180529-141503","duration":7.800},
{"time":20180601074055.886000,"channel":"FOODHD","clip":"AD_FOODHD_20180529-141511","duration":21.475},
{"time":20180601074117.589000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":14.736},
{"time":20180601074132.350000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-011154","duration":14.900},
{"time":20180601074147.559000,"channel":"FOODHD","clip":"AD_FOODHD_20180525-052652","duration":29.650},
{"time":20180601074217.006000,"channel":"FOODHD","clip":"AD_FOODHD_20180501-195219","duration":15.225},
{"time":20180601074232.490000,"channel":"FOODHD","clip":"AD_FOODHD_20180509-175437","duration":14.900},
{"time":20180601074246.490000,"channel":"FOODHD","clip":"SharpStart","duration":323.145},
{"time":20180601074810.535000,"channel":"FOODHD","clip":"AD_FOODHD_20180529-020923","duration":14.825},
{"time":20180601074825.521000,"channel":"FOODHD","clip":"AD_FOODHD_20180529-074309","duration":29.575},
{"time":20180601074855.566000,"channel":"FOODHD","clip":"AD_FOODHD_20180525-034600","duration":14.850},
{"time":20180601074910.552000,"channel":"FOODHD","clip":"AD_FOODHD_00000000-000000","duration":15.036},
{"time":20180601074925.588000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-074925","duration":29.700},
{"time":20180601074955.658000,"channel":"FOODHD","clip":"AD_FOODHD_20180525-230913","duration":14.800},
{"time":20180601075010.644000,"channel":"FOODHD","clip":"AD_FOODHD_20180529-030949","duration":14.800},
{"time":20180601075025.503000,"channel":"FOODHD","clip":"AD_FOODHD_20180527-191807","duration":29.900},
{"time":20180601075055.650000,"channel":"FOODHD","clip":"AD_FOODHD_20180528-020923","duration":14.850},
{"time":20180601075110.734000,"channel":"FOODHD","clip":"AD_FOODHD_20180530-072259","duration":29.775},
{"time":20180601075140.856000,"channel":"FOODHD","clip":"AD_FOODHD_20180601-075140","duration":29.850},


    ],
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.3,
        "gridAlpha": 0
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Europe",
        "type": "column",
		"color": "#000000",
        "valueField": "europe"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "North America",
        "type": "column",
		"color": "#000000",
        "valueField": "namerica"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Asia-Pacific",
        "type": "column",
		"color": "#000000",
        "valueField": "asia"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Latin America",
        "type": "column",
		"color": "#000000",
        "valueField": "lamerica"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Middle-East",
        "type": "column",
		"color": "#000000",
        "valueField": "meast"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Africa",
        "type": "column",
		"color": "#000000",
        "valueField": "africa"
    }],
    "categoryField": "year",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "position": "left"
    },
    "export": {
    	"enabled": true
     }

});
</script>
@endpush


@push('scripts')
@endpush