<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }} {{ Metronic::printClasses('html') }}>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-172366336-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-172366336-1');
        </script>

        <meta charset="utf-8"/>
        <meta http-equiv="Content-Security-Policy" content="child-src 'none';">

        {{-- Title Section --}}
        <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>

        {{-- Meta Data --}}
        <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Favicon --}}
        <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />

        {{-- Fonts --}}
        {{ Metronic::getGoogleFontsInclude() }}
        <style>
            @font-face {
                font-family: blowbrush;
                src: url({{asset('system/fonts/blowbrush.ttf')}});
            }
        </style>
        {{-- Global Theme Styles (used by all pages) --}}
        @foreach(config('layout.resources.css') as $style)
            <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach

        {{-- Layout Themes (used by all pages) --}}
        @foreach (Metronic::initThemes() as $theme)
            <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css"/>
        @endforeach

        {{-- Includable CSS --}}
        @yield('styles')

        <style>
            body.aside-minimize .logo-text{
                display: none !important;
            }
        </style>
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    </head>

    <body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>

        @if (config('layout.page-loader.type') != '')
            @include('layout.partials._page-loader')
        @endif

        @include('layout.base._layout')

        <script>var HOST_URL = "{{ route('quick-search') }}";</script>

        {{-- Global Config (global config for global JS scripts) --}}
        <script>
            var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
        </script>

        {{-- Global Theme JS Bundle (used by all pages)  --}}
        @foreach(config('layout.resources.js') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
        <script src="{{ asset('js/init-plugins.js') }}"></script>
        {{-- Includable JS --}}
        @yield('scripts')

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <script>
            "use strict";
            var SessionTimeout = function () {
                var initSessionTimeoutModule = function () {
                    $.sessionTimeout({
                        title: 'Session Timeout Notification',
                        message: 'Your session is about to expire.',
                        keepAlive: false,
                        logoutUrl: "#",
                        warnAfter: (60*60*1000)+(55*60*1000), //warn after 1hr55min
                        redirAfter: 2*59*60*1000, //redirect after 2hr00min,
                        ignoreUserActivity: true,
                        countdownMessage: 'Redirecting in {timer}.',
                        countdownBar: true,
                        countdownSmart: true,
                        redirUrl: "{{ route('login') }}"
                    });
                    $('#session-timeout-dialog-logout').on('click', function (e) {
                        e.preventDefault();
                        document.getElementById('logout-form').submit();
                    })
                }
                return {
                    //main function to initiate the module
                    init: function () {
                        initSessionTimeoutModule();
                    }
                };
            }();
            jQuery(document).ready(function() {
                SessionTimeout.init();
            });
        </script>
    </body>
</html>

