{{-- Extends layout --}}
@extends('layout.default')

@hasanyrole(App\User::SUPER_ADMIN_ROLE . '|' . App\User::ADMIN_ROLE)
    {{--Begin::Admin Content Section--}}
    @section('content')
        @include('pages.widgets.admin._make-appointment')
        <div class="row">
            <div class="col-lg-8 col-xxl-8">
                @include('pages.widgets.admin._today', ['class' => 'card-stretch min-h-550px gutter-b'])
            </div>
            <div class="col-lg-4 col-xxl-4">
                @include('pages.widgets._recent-comments', ['class' => 'card-stretch gutter-b'])
            </div>
        </div>
    @endsection

    {{-- Styles Section--}}
    @section('styles')
        <link type="text/css" rel="stylesheet" href="{{ asset('css/pages/wizard/wizard-3.css') }}"/>
    @endsection

    {{-- Scripts Section --}}
    @section('scripts')
        <script src="{{ asset('js/pages/backend/dashboard/admin.js') }}" type="text/javascript"></script>
    @endsection
@else

    {{--Begin::Content Section--}}
    @section('content')
        @include('pages.widgets.client._make-appointment')
        <div class="row">
            <div class="col-lg-8 col-xxl-8">
                @include('pages.widgets._upcoming-appointments', ['class' => 'card-stretch min-h-550px gutter-b'])
            </div>
            <div class="col-lg-4 col-xxl-4">
                @include('pages.widgets._recent-comments', ['class' => 'card-stretch gutter-b'])
            </div>
        </div>
    @endsection

    {{-- Styles Section--}}
    @section('styles')
        <link type="text/css" rel="stylesheet" href="{{ asset('css/pages/wizard/wizard-3.css') }}"/>
    @endsection

    {{-- Begin::Scripts Section --}}
    @section('scripts')
        <script src="{{ asset('js/pages/backend/dashboard/patient.js') }}" type="text/javascript"></script>
    @endsection
@endhasanyrole
