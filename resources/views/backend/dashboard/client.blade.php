@extends('layout.default')
@section('content')
    <div class="alert alert-primary mb-5 p-5" role="alert" id="terms-notification">
        <div class="alert-close">
        </div>
        <h4 class="alert-heading">Updated Terms of Use - This will only show once!</h4>
        <div class="border-bottom border-white opacity-20 my-5"></div>
        <p>
            We've updated our terms of use, which applies to the way we make use of information you supply to us. We’re making these updates to clarify our terms and ensure that they remain transparent for you.
        </p>
        <p class="text-right">
            <button type="button" class="btn btn-sm btn-light-primary" data-toggle="modal" data-target="#terms-of-use">
                <span aria-hidden="true">Read Terms of Use</span>
            </button>
            <button type="button" class="btn-sm btn btn-primary" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">Close</span>
            </button>
        </p>
    </div>
    <div class="row mb-10">
        <div class="col-lg-12">
            @include('pages.widgets.client._make-appointment')
        </div>
    </div>
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
