<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>

    <meta name="application-name" content="{{ config('app.name') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <title>{{ config('app.name') }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }

        html {
            overflow: auto !important;
            background-color: #f4f6f9;
        }
    </style>




    <script src="{{asset('js/adminlte/jquery.js')}}"></script>
    <script src="{{asset('js/adminlte/sortable.js')}}"></script>
    <script src="{{asset('js/adminlte/proper.js')}}"></script>
    <script src="{{asset('js/adminlte/bootstrap.js')}}"></script>
    <script src="{{asset('js/adminlte/adminlte.js')}}"></script>

    {{--    <link href="{{asset('css/adminlte/select2.css')}}" rel="stylesheet"/>--}}
    {{--    <script src="{{asset('js/adminlte/select2.js')}}"></script>--}}

    <link rel="stylesheet" href="{{asset('css/adminlte/adminlte.css')}}"/>
    @vite('resources/css/app.css')
    @livewireStyles
    @filamentStyles
    <script>

    </script>
</head>










<div
    x-data="{
    page: 'ecommerce',
     'loaded': false,
      'darkMode': false,
       'stickyMenu': false,
        'sidebarToggle': false,
         'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}" class="" data-new-gr-c-s-check-loaded="14.1156.0"
    data-gr-ext-installed=""
>

    <div class="">
        @livewire('components.layout.header')
        @livewire('components.layout.side-nav')
    </div>


    <body class="sidebar-mini layout-fixed">


    {{--    <div class="content-wrapper"  style="min-height: calc(100vh - 60px)">--}}


    <div class="content-wrapper"
         data-loading-screen="750"
        {{--         style="height: calc(100vh - 60px)"--}}
    >
        <div class="p-4">
            {{ $slot }}
        </div>
    </div>

{{--    @livewire('notifications')--}}

    @filamentScripts
    @livewireScripts
    @vite('resources/js/app.js')
    <script>
        // document.addEventListener("livewire:navigated", () => {
        //     console.log("Navigated", Livewire);
        //     // if (Livewire.on()) {
        //     //
        //     // }
        //     Livewire.start();
        // });


    </script>
    {{--    </div>--}}

    <div id="printview" style="visibility: hidden"></div>

    </body>
    <div class="jvm-tooltip text-theme-green bg-theme-green theme-green bg-opacity-10"></div>
{{--    <script>--}}

{{--        function printPage() {--}}

{{--            console.log('asda')--}}
{{--            var printContents = document.getElementById('printarea').innerHTML;--}}
{{--            var originalContents = document.getElementById('content').innerHTML;--}}

{{--            document.getElementById('content').innerHTML = printContents;--}}

{{--            window.print();--}}

{{--            document.getElementById('content').innerHTML = originalContents;--}}
{{--        }--}}

{{--        function externalTooltipHandler(context) {--}}
{{--            const {chart, tooltip} = context--}}
{{--            let tooltipEl = chart.canvas.parentNode.querySelector('.tooltipElement')--}}

{{--            if (tooltip.opacity === 0) {--}}
{{--                tooltipEl.style.opacity = 0--}}
{{--                return--}}
{{--            }--}}

{{--            if (tooltip.body) {--}}
{{--                const titleLines = tooltip.title || []--}}
{{--                const bodyLines = tooltip.body.map(b => b.lines)--}}
{{--                var innerHtml = '<span>'--}}

{{--                titleLines.forEach(function (title) {--}}
{{--                    innerHtml += title--}}
{{--                })--}}
{{--                innerHtml += '</span><span>'--}}

{{--                bodyLines.forEach(function (body, i) {--}}
{{--                    innerHtml += ' ' + body--}}
{{--                })--}}
{{--                innerHtml += '</span>'--}}

{{--                tooltipEl.innerHTML = innerHtml--}}
{{--            }--}}

{{--            const {offsetLeft: positionX, offsetTop: positionY} = chart.canvas--}}

{{--            tooltipEl.style.opacity = 1--}}
{{--            tooltipEl.style.left = positionX + tooltip.caretX + 'px'--}}
{{--            tooltipEl.style.top = positionY + tooltip.caretY + 'px'--}}
{{--        }--}}

{{--    </script>--}}

{{--    <script>--}}
{{--        (document.querySelectorAll(".connectedSortable") ?? []).forEach((connectedSortable) => {--}}
{{--            let sortable = new Sortable(connectedSortable, {--}}
{{--                group: "shared",--}}
{{--                handle: ".card-header",--}}
{{--            });--}}
{{--        });--}}
{{--        (document.querySelectorAll(".connectedSortable .card-header",) ?? []).forEach((cardHeader) => {--}}
{{--            cardHeader.style.cursor = "move";--}}
{{--        });--}}
{{--    </script>--}}
</div>

</html>


