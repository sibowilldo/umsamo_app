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
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('system/favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('system/favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('system/favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('system/favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('system/favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('system/favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('system/favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('system/favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('system/favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('system/favicons/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('system/favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('system/favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('system/favicons/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('system/favicons/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('system/favicons/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#ffffff">

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
            .swal2-popup.swal2-toast .swal2-content {
                margin-top: 0;
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
        @include('flash::message')
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
                var initSwalToast = function(){
                    window.Toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 6000,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', swal.stopTimer)
                            toast.addEventListener('mouseleave', swal.resumeTimer)
                        }
                    })
                };
                return {
                    //main function to initiate the module
                    init: function () {
                        initSwalToast();
                        initSessionTimeoutModule();
                    }
                };
            }();
            jQuery(document).ready(function() {
                SessionTimeout.init();
            });
        </script>

        <style>
            .phpdebugbar-widgets-sql-duplicate{
                background-color: hotpink !important;
                border-bottom: 1px solid #fff;
            }
        </style>
    @if(Auth::user()->hasRole('client') && config('app.chat.logged_in_pages.enabled'))
        <script src="{{ asset('js/plugins/tawk-to.js') }}" type="text/javascript" defer></script>
    @endif
    </body>
</html>

