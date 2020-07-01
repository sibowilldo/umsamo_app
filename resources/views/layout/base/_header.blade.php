{{-- Header --}}
<div id="kt_header" class="header {{ Metronic::printClasses('header', false) }}" {{ Metronic::printAttrs('header') }}>

    {{-- Container --}}
    <div class="container-fluid d-flex align-items-center justify-content-between">
        @if (config('layout.header.self.display'))

            @php
                $kt_logo_image = 'logo-light.png';
            @endphp

            @if (config('layout.header.self.theme') === 'light')
                @php $kt_logo_image = 'logo-dark.png' @endphp
            @elseif (config('layout.header.self.theme') === 'dark')
                @php $kt_logo_image = 'logo-light.png' @endphp
            @endif

            {{-- Header Menu --}}
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                @if(config('layout.aside.self.display') == false)
                    <div class="header-logo">
                        <a href="{{ url('/') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 334.75 335.54"><defs><style>.cls-1,.cls-6{fill:#fff;}.cls-2,.cls-3,.cls-5,.cls-7{fill:none;stroke:#fff;stroke-miterlimit:10;}.cls-2{stroke-width:4px;}.cls-3{stroke-width:2px;}.cls-4{fill-rule:evenodd;}.cls-5{stroke-linecap:round;stroke-width:4.88px;}.cls-6{font-size:34.44px;font-family:BlowBrush, BlowBrush;}</style></defs><title>Artboard 1_1</title><g id="Layer_1" data-name="Layer 1"><path class="cls-1" d="M199.86,114.48a67.3,67.3,0,0,1-65,4l-10.65-22a49.47,49.47,0,0,0,89.31-29.31s6.28,23.89-12.38,42.72Z"/><path class="cls-1" d="M199.86,114.48a67.3,67.3,0,0,1-65,4l.26,11.67a86.61,86.61,0,0,0,70.71,14.72s-9.14-9.45-6-26.95Z"/><path class="cls-1" d="M195.73,180.14a41.44,41.44,0,0,1-65.25-33.92c0-1,0-2.05.11-3.05l-12.51,10.91s2.59,19.63,26.55,32.59c0,0,22.81,13.16,51.51-4.87Z"/><path class="cls-1" d="M261.58,212.48A98.93,98.93,0,0,1,87.93,201.72s32.74,42.23,86.82,37.72c0,0,54.6-3,79.32-52.77,0,0,6.49,15.23,7,20.52s.18,1.4.18,1.4Z"/><path class="cls-1" d="M256.43,240.22a101.72,101.72,0,0,1-175.49-54S51.86,233.8,106.35,270.7c0,0,62.28,44.06,133.05-8.52,0,0,9.64-10.08,13.34-16Z"/><path class="cls-1" d="M146.43,230.26a91.28,91.28,0,0,1-40.28-20.49l26.75-5.84Z"/><path class="cls-1" d="M216,217.8c-14.08,8.85-31.7,14.65-49.56,14.65a20.08,20.08,0,0,1-5.18-.52l19.24-24.74Z"/><path class="cls-1" d="M250,178.13a91.77,91.77,0,0,1-27.25,34l-.9-30.7Z"/><path class="cls-1" d="M84.64,181.94a91.23,91.23,0,0,0,13.16,19.5l9.12-21Z"/><path class="cls-2" d="M254.07,186.66a98.83,98.83,0,0,1-174.32,1.75"/><path class="cls-2" d="M215.18,151.89a49.83,49.83,0,0,1-97.59.07"/><path class="cls-1" d="M117.84,67.85A18.89,18.89,0,0,1,149.3,82a19.62,19.62,0,0,1-.28,3.28,18.94,18.94,0,0,1,36.9-.54,18.37,18.37,0,0,1-.84-6,18.91,18.91,0,0,1,30.58-14.87l-9-15.9a62.66,62.66,0,0,1-40,14.35,66.09,66.09,0,0,1-39.45-13.15Z"/><path class="cls-3" d="M216.54,71.59a73.29,73.29,0,0,1-99.31.53"/><polygon class="cls-1" points="119.59 172.27 108.23 198.69 138.13 192.83 154.93 224.25 177.78 197.42 212.62 205.85 213.07 174.22 237.99 169.66 243.16 173.89 217.29 178.51 217.46 212.51 179.17 202.39 154.26 231.93 135.84 198.01 101.34 204.19 113.55 176.35 86.4 178.01 92 173.43 119.59 172.27"/><path class="cls-4" d="M220.32,100.12a1.45,1.45,0,0,1-1.42.91c-.08-.47.48-.57.76-.51C219.87,100.37,220,100.14,220.32,100.12Z"/><path class="cls-4" d="M230.07,99.56c-.07-.11.32.09.35.2.25-.06.63.44.41.21A3.68,3.68,0,0,1,230.07,99.56Z"/><path class="cls-1" d="M215.15,68.53A70.2,70.2,0,0,1,189.9,84.15h0a15,15,0,0,1-1-5.45,15.1,15.1,0,0,1,26.27-10.17"/><path class="cls-1" d="M152.66,86.8a15.11,15.11,0,0,1,29.74-.46h0a70.28,70.28,0,0,1-15.93,1.82,70.51,70.51,0,0,1-13.8-1.36Z"/><path class="cls-1" d="M120.24,70.8A15.1,15.1,0,0,1,145.51,82a14.83,14.83,0,0,1-.29,2.92h0a70.12,70.12,0,0,1-25-14.09Z"/><path class="cls-5" d="M187.37,31.78a48.48,48.48,0,0,1-27,91.94"/><path class="cls-5" d="M186.5,30.81c0,2.47-8.82,4.47-19.7,4.47s-19.7-2-19.7-4.47,8.82-4.47,19.7-4.47S186.5,28.34,186.5,30.81Z"/><path class="cls-1" d="M111.11,157.73a57.3,57.3,0,0,0,4.26,10.35l-20.2,1.41,7.92-7Z"/><path class="cls-1" d="M121.25,177a58,58,0,0,0,13,12l-19.73,4.22Z"/><path class="cls-1" d="M169.33,198.71c-1,0-1.92.08-2.89.08a57.59,57.59,0,0,1-21.11-4l10.11,20.9Z"/><path class="cls-1" d="M207.37,181.8a58,58,0,0,1-18,12.27l18.36,4.55Z"/><path class="cls-1" d="M222.23,158c-.84,3.09-3.28,7.73-4.6,10.59l16.87-2.5Z"/><path class="cls-5" d="M201.19,111.8a31.63,31.63,0,0,0,15.71,41.52l.84.48c26.39,12.89,43.91,35.6,43.91,61.47,0,40.16-42.21,72.71-94.28,72.71S73.1,255.43,73.1,215.27c0-25.55,17.08-48,42.93-61l1.27-.6a31.59,31.59,0,0,0,13.1-46l-.07-.11-.09-.11-.41-.48-.73-.87a48.5,48.5,0,0,1,17.41-74.51"/><text class="cls-6" transform="translate(26.53 256.16) rotate(56.76)">U</text><text class="cls-6" transform="translate(39.45 275.5) rotate(47.82)">M</text><text class="cls-6" transform="matrix(0.78, 0.63, -0.63, 0.78, 58.74, 295.9)">S</text><text class="cls-6" transform="matrix(0.85, 0.52, -0.52, 0.85, 74.9, 308.71)">A</text><text class="cls-6" transform="matrix(0.92, 0.38, -0.38, 0.92, 94.46, 320.49)">M</text><text class="cls-6" transform="translate(120.61 330.67) rotate(13.55)">O</text><text class="cls-6" transform="matrix(0.99, 0.13, -0.13, 0.99, 142.04, 335.36)"> </text><text class="cls-6" transform="matrix(1, 0.06, -0.06, 1, 154.64, 336.83)">I</text><text class="cls-6" transform="translate(166.18 337.53) rotate(-2.68)">N</text><text class="cls-6" transform="translate(188.61 336.15) rotate(-10.56)">S</text><text class="cls-6" transform="matrix(0.95, -0.3, 0.3, 0.95, 209.17, 332.05)">T</text><text class="cls-6" transform="matrix(0.92, -0.39, 0.39, 0.92, 227.66, 325.76)">I</text><text class="cls-6" transform="translate(238.18 321.27) rotate(-28.64)">T</text><text class="cls-6" transform="matrix(0.81, -0.59, 0.59, 0.81, 255.09, 311.85)">U</text><text class="cls-6" transform="matrix(0.73, -0.69, 0.69, 0.73, 273.35, 298.14)">T</text><text class="cls-6" transform="matrix(0.63, -0.77, 0.77, 0.63, 287.72, 284.22)">E</text></g><g id="Layer_2" data-name="Layer 2"><path class="cls-1" d="M276.71,238.92h-2.66v-1.08h6.54v1.08h-2.68v6h-1.2Zm5.12-1.08h1.28l2.32,3.1,2.29-3.1H289v7.08h-1.18V239.6l-2.35,3.16L283,239.6v5.32h-1.21Z"/><path class="cls-7" d="M292.65,241.38a11.13,11.13,0,1,1-11.12-11.12A11.12,11.12,0,0,1,292.65,241.38Z"/></g></svg>
{{--                            <img alt="Logo" src="{{ asset('media/logos/'.$kt_logo_image) }}"/>--}}
                        </a>
                    </div>
                @endif

                <div id="kt_header_menu" class="header-menu header-menu-mobile {{ Metronic::printClasses('header_menu', false) }}" {{ Metronic::printAttrs('header_menu') }}>
                    <ul class="menu-nav {{ Metronic::printClasses('header_menu_nav', false) }}">
                        {{ MetroMenu::renderHorMenu(config('menu_header.items')) }}
                    </ul>
                </div>
            </div>

        @else
            <div></div>
        @endif

        @include('layout.partials.extras._topbar')
    </div>
</div>
