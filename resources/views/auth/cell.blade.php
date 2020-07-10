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
<div class="vh-100 d-flex flex-column justify-content-center align-items-center  bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ asset("media/bg/bg-8.jpg") }}');">
    <div class="d-flex flex-center mb-15">
        <a href="{{ route('login') }}">
            <img src="{{ asset('system/images/umsamo-logo-white.png') }}" class="max-h-175px" alt="{{ config('app.name') }}" />
        </a>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">

            <div class="card card-custom text-center bg-light gutter-b card-stretch shadow m-5" style="background-color: rgba(255,255,255,.5) !important; backdrop-filter: blur(10px)">
                <!--begin::Body-->
                <div class="card-body">
                    <form class="d-inline" method="POST" action="{{ route('auth.cell.confirm') }}">
                        @csrf
                        <div class="p-4 flex-column ">
                            <h3 class="text-dark font-weight-bolder mb-7">{{ __('Verify Your Cell Phone Number') }}</h3>
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <p class="font-size-lg mb-7">
                                {{ __('We have sent you an SMS containing a One Time Pin, ') }}
                                {{ __('using the cell number you provided during registration.') }}
                            </p>
                            <div class="form-group">
                                <label for="onetime" class="font-weight-bolder">Enter One Time Pin</label>
                                <input type="text" class="form-control text-center" name="onetime" id="onetime" placeholder=""/>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-light-danger px-6 py-3">
                                    {{ __('Request Another') }}
                                </button>
                                <button type="submit" class="btn btn-primary font-weight-bolder px-6 py-3">
                                    {{ __('Verify OTP') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--end::Body-->
            </div>
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