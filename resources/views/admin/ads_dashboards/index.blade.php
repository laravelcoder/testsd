@extends('layouts.adashboard')

@push('pagestyle')
<!-- Styles -->
<style>
#highcharts-767b7fd1-956c-4f66-93fd-d2d060e7f849 {
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
<div class="col-md-1"></div>
<div class="col-md-10">
<div id="highcharts-767b7fd1-956c-4f66-93fd-d2d060e7f849"></div>

</div>
<div class="col-md-1"></div>
<hr style="clear:both" />
    <!-- HTML -->
    <br style="clear:both" />
{{-- <div id="chartdiv" style="background:#fff;""></div> --}}

@stop

@push('topscripts')
<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
{{-- https://www.amcharts.com/demos/duration-on-value-axis/ --}}
<!-- Chart code -->
 
<script>
(function() {
    var files = ["https://code.highcharts.com/stock/highstock.js", "https://code.highcharts.com/highcharts-more.js", "https://code.highcharts.com/highcharts-3d.js", "https://code.highcharts.com/modules/data.js", "https://code.highcharts.com/modules/exporting.js", "http://code.highcharts.com/modules/funnel.js", "http://code.highcharts.com/modules/solid-gauge.js"],
        loaded = 0;
    if (typeof window["HighchartsEditor"] === "undefined") {
        window.HighchartsEditor = {
            ondone: [cl],
            hasWrapped: false,
            hasLoaded: false
        };
        include(files[0]);
    } else {
        if (window.HighchartsEditor.hasLoaded) {
            cl();
        } else {
            window.HighchartsEditor.ondone.push(cl);
        }
    }

    function isScriptAlreadyIncluded(src) {
        var scripts = document.getElementsByTagName("script");
        for (var i = 0; i < scripts.length; i++) {
            if (scripts[i].hasAttribute("src")) {
                if ((scripts[i].getAttribute("src") || "").indexOf(src) >= 0 || (scripts[i].getAttribute("src") === "http://code.highcharts.com/highcharts.js" && src === "https://code.highcharts.com/stock/highstock.js")) {
                    return true;
                }
            }
        }
        return false;
    }

    function check() {
        if (loaded === files.length) {
            for (var i = 0; i < window.HighchartsEditor.ondone.length; i++) {
                try {
                    window.HighchartsEditor.ondone[i]();
                } catch (e) {
                    console.error(e);
                }
            }
            window.HighchartsEditor.hasLoaded = true;
        }
    }

    function include(script) {
        function next() {
            ++loaded;
            if (loaded < files.length) {
                include(files[loaded]);
            }
            check();
        }
        if (isScriptAlreadyIncluded(script)) {
            return next();
        }
        var sc = document.createElement("script");
        sc.src = script;
        sc.type = "text/javascript";
        sc.onload = function() {
            next();
        };
        document.head.appendChild(sc);
    }

    function each(a, fn) {
        if (typeof a.forEach !== "undefined") {
            a.forEach(fn);
        } else {
            for (var i = 0; i < a.length; i++) {
                if (fn) {
                    fn(a[i]);
                }
            }
        }
    }
    var inc = {},
        incl = [];
    each(document.querySelectorAll("script"), function(t) {
        inc[t.src.substr(0, t.src.indexOf("?"))] = 1;
    });

    function cl() {
        if (typeof window["Highcharts"] !== "undefined") {
            var options = {
                "title": {
                    "text": "My Chart"
                },
                "subtitle": {
                    "text": "My Untitled Chart"
                },
                "exporting": {},
                "yAxis": [{
                    "title": {}
                }],
                "chart": {},
                "series": [{
                    "name": "GPR",
                    "_colorIndex": 0,
                    "_symbolIndex": 0
                }],
                "plotOptions": {
                    "series": {
                        "animation": false
                    }
                },
                "data": {
                    "csv": "\"REACH\";\" GPR\"\n32;40\n46;80\n54;140\n59;160\n62;200\n65;240\n67;280\n68;320\n69;360\n71;400\n72;440\n72;480\n73;520",
                    "googleSpreadsheetKey": false,
                    "googleSpreadsheetWorksheet": false
                }
            };
            new Highcharts.Chart("highcharts-767b7fd1-956c-4f66-93fd-d2d060e7f849", options);
        }
    }
})();
</script>
@endpush


@push('scripts')
@endpush