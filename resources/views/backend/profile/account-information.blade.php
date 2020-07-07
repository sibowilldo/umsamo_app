@extends('layout.default')

@section('mobile-toggle')
    <button class="mr-4 d-inline-block d-lg-none btn btn-light-success" id="kt_subheader_mobile_toggle">
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
                            <div class="card-toolbar">
                                <button type="submit" class="btn btn-success mr-2 font-weight-bold" id="accountInformationSubmitButton">Save Changes</button>
                                <a class="btn btn-secondary font-weight-bold" href="{{ route('profiles.overview', $user) }}">Cancel</a>
                            </div>
                        </div>
                        <!--end::Header-->

                        <div class="alert alert-light-danger alert-custom rounded-0 text-center d-flex flex-row align-items-center">
                            <span class="svg-icon svg-icon-3x svg-fill-light-danger svg-icon-danger mr-5">{{ Metronic::getSvg('media/svg/icons/Code/Warning-2.svg') }}</span>
                            <span class="font-size-h6 text-uppercase text-danger font-weight-bold">Update this section with care!</span>
                        </div>

                        <!--begin::Form-->
                        <form class="form" action="{{ route('profiles.update', $user->profile) }}" id="accountInformationForm">
                            <input type="hidden" name="update" value="account:information">
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">Cell Number</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="text" class="form-control form-control-solid form-control-lg text-muted" name="id_number" placeholder="" readonly disabled value="{{ $user->profile->cell_number }}" />
                                        <span class="help-block text-warning">If you change this you will not receive SMS notifications until you have verified the new number.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">Email Address</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="text" class="form-control form-control-solid form-control-lg text-muted" name="date_of_birth" placeholder="" readonly disabled value="{{ $user->email }}" />
                                        <span class="help-block text-danger">Changing this will immediately invalidate your account and terminate your session (logout)</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </form>
                        <!--end::Form-->
                    </div>
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
@stop
