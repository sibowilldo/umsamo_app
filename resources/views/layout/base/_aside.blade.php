{{-- Aside --}}

@php
    $kt_logo_image = 'logo-light.png';
@endphp

@if (config('layout.brand.self.theme') === 'light')
    @php
        $kt_logo_image = 'umsamo-logo-color.png';
        $logo_text_color = 'text-dark ';
    @endphp
@elseif (config('layout.brand.self.theme') === 'dark')
    @php $kt_logo_image = 'umsamo-logo-white.png';
        $logo_text_color = 'text-white ';
 @endphp
@endif
<div class="aside aside-left {{ Metronic::printClasses('aside', false) }} d-flex flex-column flex-row-auto" id="kt_aside">

    {{-- Brand --}}
    <div class="brand flex-column-auto {{ Metronic::printClasses('brand', false) }}" id="kt_brand">
        <div class="brand-logo">
            <a href="{{ url('/') }}" class="{{$logo_text_color}} d-flex align-items-center">
                <img alt="{{ config('app.name') }}" src="{{asset("system/images/$kt_logo_image")}}" class="w-50px h-50px"/>
                <span class="logo-container logo-text"><span style="font-family: blowbrush,serif;" class="text-uppercase font-size-h5">{{ config('app.name') }}</span><sup>&trade;</sup></span>
            </a>
        </div>

        @if (config('layout.aside.self.minimize.toggle'))
            <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                {{ Metronic::getSVG("media/svg/icons/Navigation/Angle-double-left.svg", "svg-icon-xl") }}
            </button>
        @endif

    </div>

    {{-- Aside menu --}}
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">

        @if (config('layout.aside.self.display') === false)
            <div class="header-logo">
                <a href="{{ url('/') }}">
                    <img alt="{{ config('app.name') }}" src="{{ asset('media/logos/'.$kt_logo_image) }}"/>
                </a>
            </div>
        @endif

        <div
            id="kt_aside_menu"
            class="aside-menu my-4 {{ Metronic::printClasses('aside_menu', false) }}"
            data-menu-vertical="1"
            {{ Metronic::printAttrs('aside_menu') }}>

            <ul class="menu-nav {{ Metronic::printClasses('aside_menu_nav', false) }}">
                {{ MetroMenu::renderVerMenu(config('menu_aside.items')) }}
            </ul>
        </div>
    </div>

</div>
