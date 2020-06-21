{{-- Header Mobile --}}
<div id="kt_header_mobile" class="header-mobile {{ Metronic::printClasses('header-mobile', false) }}" {{ Metronic::printAttrs('header-mobile') }}>
    <div class="mobile-logo">
        <a href="{{ url('/') }}">

            @php
                $kt_logo_image = 'logo-light.png'
            @endphp

            @if (config('layout.aside.self.display') == false)

                @if (config('layout.header.self.theme') === 'light')
                    @php
                        $logo_text_color = 'text-dark ';
                    @endphp
                @elseif (config('layout.header.self.theme') === 'dark')
                    @php
                        $logo_text_color = 'text-white ';
                    @endphp
                @endif

            @else

                @if (config('layout.brand.self.theme') === 'light')
                    @php
                        $logo_text_color = 'text-dark ';
                     @endphp
                @elseif (config('layout.brand.self.theme') === 'dark')
                    @php
                        $logo_text_color = 'text-white ';
                     @endphp
                @endif

            @endif

{{--            <img alt="{{ config('app.name') }}" src="{{ asset('system/images/'.$kt_logo_image) }}"/>--}}
            <span class=" {{$logo_text_color}}"><span style="font-family: blowbrush,serif;" class="text-uppercase font-size-h4">{{ config('app.name') }}</span><sup>&trade;</sup></span>
        </a>
    </div>
    <div class="mobile-toolbar">

        @if (config('layout.aside.self.display'))
            <button class="mobile-toggle mobile-toggle-left btn" id="kt_aside_mobile_toggle"><i class="flaticon2-grids"></i><span class="text-uppercase font-weight-bolder">Menu</span></button>
        @endif

        @if (config('layout.header.menu.self.display'))
            <button class="mobile-toggle ml-3 btn btn-icon" id="kt_header_mobile_toggle"><i class="flaticon2-layers"></i></button>
        @endif

        <button class="topbar-toggle ml-3 btn btn-icon" id="kt_header_mobile_topbar_toggle">
            {{ Metronic::getSVG('media/svg/icons/General/User.svg') }}
        </button>
    </div>
</div>
