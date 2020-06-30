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
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch" id="kt_page_sticky_card">
                        <!--begin::Header-->
                        <div class="card-header py-3">
                            <div class="card-title align-items-start flex-column">
                                <h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
                                <span class="text-muted font-weight-bold font-size-sm mt-1">Update your personal information</span>
                            </div>
                            <div class="card-toolbar">
                                <button type="submit" class="btn btn-success mr-2 font-weight-bold" id="personalInformationSubmitButton">Save Changes</button>
                                <a class="btn btn-secondary font-weight-bold" href="{{ route('profiles.overview', $user) }}">Cancel</a>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form class="form" action="{{ route('profiles.update', $user->profile) }}" id="personalInformationForm">
                            <input type="hidden" name="update" value="personal:information">
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-xl-3"></label>
                                    <div class="col-lg-9 col-xl-6">
                                        <h5 class="font-weight-bold mb-6">Personal Info</h5>
                                    </div>
                                </div>
                                @if(false)
                                    {{-- ToDo: MVP-2 Enable Avatars --}}
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">Avatar</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url({{asset('media/users/blank.png')}})">
                                            <div class="image-input-wrapper" style="background-image: url({{asset('media/users/300_21.jpg')}})"></div>
                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="profile_avatar_remove" />
                                            </label>
                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
																	<i class="ki ki-bold-close icon-xs text-muted"></i>
																</span>
                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
																	<i class="ki ki-bold-close icon-xs text-muted"></i>
																</span>
                                        </div>
                                        <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">ID Number</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="text" class="form-control form-control-solid form-control-lg text-muted" name="id_number" placeholder="" readonly disabled value="{{ $user->profile->id_number }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">Date of Birth</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="text" class="form-control form-control-solid form-control-lg text-muted" name="date_of_birth" placeholder="" readonly disabled value="{{ $user->profile->date_of_birth->format('M d, Y') }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">First Name</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="text" class="form-control form-control-solid form-control-lg" name="first_name" placeholder="" value="{{ $user->profile->first_name }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">Last Name</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="text" class="form-control form-control-solid form-control-lg" name="last_name" placeholder="" value="{{ $user->profile->last_name }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">Gender</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="radio-inline">
                                            <label class="radio radio-disabled">
                                                <input type="radio" name="gender" disabled value="M" {{ $user->profile->gender === 'M'?'checked':'' }}/> Male
                                                <span></span>
                                            </label>
                                            <label class="radio radio-disabled">
                                                <input type="radio" name="gender" disabled value="F" {{ $user->profile->gender === 'F'?'checked':'' }}/> Female
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-xl-3"></label>
                                    <div class="col-lg-9 col-xl-6">
                                        <h5 class="font-weight-bold mt-10 mb-6">Address Info</h5>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">Address</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="input-group input-group-lg input-group-solid">
                                                <input type="text" class="form-control form-control-solid form-control-lg" name="address" placeholder="Addresss" value="{{ $user->profile->address }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">City</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="input-group input-group-lg input-group-solid">
                                                <input type="text" class="form-control form-control-solid form-control-lg" name="city" placeholder="City" value="{{ $user->profile->city }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">Province</label>
                                    <div class="col-lg-9 col-xl-6">
                                        {{ Form::select('province', \App\Region::$provinces, $user->profile->province, ['class' => 'form-control text-dark form-control-solid kt-selectpicker','data-size'=>'5',  'data-live-search' => 'true']) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">Postal Code</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="input-group input-group-lg input-group-solid">
                                            <input type="text" class="form-control form-control-solid form-control-lg" name="postal_code" placeholder="Postal Code" value="{{ $user->profile->postal_code }}" />
                                        </div>
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
    <script src="{{ asset('js/pages/backend/profile/personal-information.js') }}"></script>
@stop
