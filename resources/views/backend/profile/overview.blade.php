@extends('layout.default')

@section('mobile-toggle')
    <button class="mr-4 d-inline-block d-lg-none btn btn-light-success btn-sm" id="kt_subheader_mobile_toggle">
        <span></span>
        {{ Metronic::getSVG('media/svg/icons/Navigation/Arrow-from-left.svg') }}
    </button>
@endsection

@section('content')

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Profile Overview-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
                    @include('backend.profile.common._side-bar')
                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-xl-6 col-md-12">
                            @include('pages.widgets._recent-comments', ['class'=>' card-stretch gutter-b'])
                        </div>
                        <div class="col-xl-6 col-md-12">
                            @include('pages.widgets._user-families')
                        </div>
                    </div>
                    <!--end::Row-->

                    @include('pages.widgets._upcoming-appointments', ['class'=> 'min-h-600px'])
                </div>
                <!--end::Content-->
            </div>
            <!--end::Profile Overview-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@stop

@section('scripts')
    <script src="{{ asset('js/pages/backend/profile/offcanvas.js') }}"></script>
    <script src="{{ asset('js/pages/backend/profile/overview.js') }}"></script>
@stop
