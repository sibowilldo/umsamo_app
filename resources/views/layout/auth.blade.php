<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }} {{ Metronic::printClasses('html') }}>
<!--begin::Head-->
<head><base href="../../../">
    <meta charset="utf-8" />
    {{-- Title Section --}}
    <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>

    {{-- Meta Data --}}
    <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    {{--  CSRF Token --}}
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

    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('css/pages/login/login-1.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->

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

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-row-fluid bg-white" id="kt_login">
        <!--begin::Aside-->
            <div class="login-aside d-sm-none d-md-flex d-lg-flex d-xl-flex d-xxl-flex flex-row-auto px-lg-0 px-5 pb-sm-40 pb-lg-40 flex-grow-1" style="background-repeat:no-repeat;background-position: bottom;background-color:#221f72;">
                <!--begin::Aside Container-->
                <div class="d-flex flex-row-fluid flex-column justify-content-around mt-lg-30 mb-lg-0 pb-lg-0 mt-0 pt-15">
                    <!--begin::Aside header-->
                    <a href="#" class="text-center mb-10">
                        <img src="{{asset('system/images/umsamo-logo-white.png')}}" class="max-h-250px" alt="" />
                    </a>
                    <!--end::Aside header-->
                </div>
                <!--end::Aside Container-->
            </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="min-vh-100 login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 ml-auto mr-auto">
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid flex-center mt-6 mt-lg-0">
                @yield('content')
            </div>
            <!--end::Content body-->
            <!--begin::Content footer-->
            <div class="d-flex justify-content-lg-start justify-content-center flex-column-fluid align-items-end pb-2 pt-lg-0">
                <a href="#" class="text-primary font-weight-bolder font-size-h5">Terms</a>
                <a href="#" class="text-primary ml-10 font-weight-bolder font-size-h5">Plans</a>
                <a href="#" class="text-primary ml-10 font-weight-bolder font-size-h5">Contact Us</a>
            </div>
            <!--end::Content footer-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->
<script>var HOST_URL = "{{ config('app.url') }}";</script>

{{-- Global Config (global config for global JS scripts) --}}
<script>
    var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
</script>

{{-- Global Theme JS Bundle (used by all pages)  --}}
@foreach(config('layout.resources.js') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
@endforeach

{{-- Includable JS --}}
@yield('scripts')
</body>
<!--end::Body-->
</html>
