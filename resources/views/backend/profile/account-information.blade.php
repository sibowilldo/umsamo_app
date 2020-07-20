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
                    <!--begin::Card-->
                        <div class="card card-custom card-stretch" id="kt_page_sticky_card">
                        <!--begin::Header-->
                        <div class="card-header py-3">
                            <div class="card-title align-items-start flex-column">
                                <h3 class="card-label font-weight-bolder text-dark">Account Information</h3>
                                <span class="text-muted font-weight-bold font-size-sm mt-1">Update your account information</span>
                            </div>
                        </div>
                        <!--end::Header-->
                        <div class="alert alert-light-danger alert-custom rounded-0 text-left d-flex flex-row align-items-end">
                            <span class="svg-icon svg-icon-3x svg-fill-light-danger svg-icon-danger mr-5">{{ Metronic::getSvg('media/svg/icons/Code/Warning-2.svg') }}</span>
                            <p class="text-danger m-0 alert-text"><span class="font-weight-bolder d-block">Update this section with care!</span>You will not be able to use your account until you have verified your new information.</p>
                        </div>

                        <!--begin::Form-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <form action="{{ route('profile.update.cell', $user->uuid) }}" method="post" id="changeCellNumberForm">
                                    @csrf
                                    {{ method_field('patch') }}
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Cell Phone Number</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="d-flex">
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="cell_number" value="{{ $user->profile->cell_number }}"/>
                                                <button class="btn btn-success font-weight-bold ml-5" type="button" id="changeCellNumberSubmit">{{ Metronic::getSvg('media/svg/icons/Navigation/Double-check.svg') }} </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form action="{{ route('user.update.email', $user->uuid) }}" id="changeEmailForm">
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Email Address</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="d-flex">
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="email" value="{{ $user->email }}">
                                                <button class="btn btn-success font-weight-bold ml-5" type="button" id="changeEmailSubmit">{{ Metronic::getSvg('media/svg/icons/Navigation/Double-check.svg') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <!--end::Body-->
                    </div>
                    <!--end::Card-->
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
    <script src="{{ asset('js/pages/auth/account-information.js') }}">  </script>
@stop
