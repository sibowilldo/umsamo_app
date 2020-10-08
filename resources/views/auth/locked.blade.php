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
        .locked{
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(20px);
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
<div class="vh-100 d-flex flex-column justify-content-center align-items-center  bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ asset("media/bg/bg-3.jpg") }}');">
<div>  <!--begin::Form-->
    <form class="form" novalidate="novalidate" id="loginForm" method="POST" action="{{ route('auth.unlock.account') }}">
        @csrf
        <div class="card min-w-350px card-custom text-center bg-transparent gutter-b card-stretch shadow m-5" style="background-color: rgba(255,255,255,.3); backdrop-filter: blur(10px)">
            <div class="card-header border-0 align-items-center justify-content-center flex-column">
                <a href="{{ route('login') }}" class="d-inline-block m-5">
                    <img src="{{ asset('system/images/umsamo-logo-color.png') }}" class="max-h-175px" alt="{{ config('app.name') }}" />
                </a>
                <h3 class="text-uppercase text-dark-75 font-weight-bolder mt-10 font-size-h1">Unlock Account</h3>
            </div>
            @if($token && $user)
                <div class="mt-lg-10">
                    <div class="alert alert-success rounded-0">
                        <span class="font-weight-bold text-white"><strong>TO UNLOCK:</strong> Please enter your email address and click "Unlock Account"</span>
                    </div>
                </div>
                    <div class="card-body">
                        <input type="hidden" name="who" value="{{ $user }}">
                        <input type="hidden" name="how" value="{{ $token }}">
                        <!--begin::Form group-->
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto rounded-lg py-5" type="email" name="email" autocomplete="off" placeholder="Email Address" value="" />
                        </div>
                        <!--end::Form group-->
                    </div>
                    <div class="card-footer d-flex justify-content-end bg-gray-100 p-3 m-0">
                        <button type="submit" id="loginSubmitButton" class="btn btn-light-primary font-weight-bold px-8 py-4 my-3 mr-3">Unlock Account</button>
                    </div>
            @else
            <div class="alert alert-danger my-15 rounded-0">
                <span class="font-weight-bold text-white"><strong>STOP:</strong> This account is locked by its owner, <br>and can only be unlocked with a unique link that was sent to them.</span>
            </div>
            @endif
        </div>
    </form>
    <!--end::Form-->
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
<!--end:Verify-->
<script src="{{ asset('js/plugins/tawk-to.js') }}" type="text/javascript" defer></script>
</body>
</html>
