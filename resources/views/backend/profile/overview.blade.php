@extends('layout.default')

@section('mobile-toggle')
    <button class="mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
        <span></span>
        {{ \App\Classes\Theme\Metronic::getSVG('media/svg/icons/Navigation/Arrow-from-left.svg') }}
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
                        <div class="col-lg-6">
                            @include('pages.widgets._recent-comments', ['class'=>' card-stretch gutter-b'])
                        </div>
                        <div class="col-lg-6">
                            @include('pages.widgets._user-families')
                        </div>
                    </div>
                    <!--end::Row-->

                    @include('pages.widgets._upcoming-appointments')
                </div>
                <!--end::Content-->
            </div>
            <!--end::Profile Overview-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@stop

@section('js')
@stop
