<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }} {{ Metronic::printClasses('html') }}>
<head>
    <meta charset="utf-8"/>

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


    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
</head>

<body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>
<!--begin::Verify-->
<div class="vh-100 d-flex flex-column justify-content-center align-items-center  bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ asset("media/bg/bg-11.jpg") }}');">
    <div class="d-flex flex-center mb-15">
        <a href="{{ route('login') }}">
            <img src="{{ asset('system/images/umsamo-logo-white.png') }}" class="max-h-175px" alt="{{ config('app.name') }}" />
        </a>
    </div>
    <div>
        <div class="card card-custom bg-light gutter-b card-stretch shadow m-5">
            <!--begin::Body-->
            <div class="card-body">
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <div class="p-4 flex-column ">
                        <h3 class="text-dark font-weight-bolder mb-7">{{ __('Verify Your Email Address') }}</h3>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        <p class="text-muted font-size-lg mb-7">
                            {{ __('Before proceeding, please check your email inbox or spam folder for a verification link.') }}
                            {{ __('If you did not receive the email') }}
                        </p>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-danger font-weight-bolder px-6 py-3">
                                {{ __('Request another') }}
                            </button>
                            <button class="btn btn-light-primary font-weight-bold px-6 py-3 btn-logout" type="button">
                                {{ __('Leave this page!') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!--end::Body-->
        </div>
    </div>
</div>
<script>var HOST_URL = "{{ config('app.url') }}";</script>

{{-- Global Config (global config for global JS scripts) --}}
<script>
    var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
</script>
{{-- Global Theme JS Bundle (used by all pages)  --}}
@foreach(config('layout.resources.js') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
@endforeach

<script src="{{ asset('js/pages/auth/verify.js') }}" type="text/javascript"></script>
<!--end:Verify-->
</body>
</html>
