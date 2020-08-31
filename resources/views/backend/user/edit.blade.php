@extends('layout.default')

@section('content')
    <!--begin::Edit Details-->
    <div class="card card-custom">
        <div class="card-body py-0">
            <!--begin: Wizard-->
            <div class="wizard wizard-2" id="kt_wizard_v2" data-wizard-state="step-first" data-wizard-clickable="false">
                <!--begin: Wizard Nav-->
                <div class="wizard-nav border-right-lg border-right-sm-0 py-8 px-8 py-lg-20 px-lg-10">
                    <div class="wizard-steps">
                        <!--begin::Wizard Step 1 Nav-->
                        <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                            <div class="wizard-wrapper">
                                <div class="wizard-icon">
                                    {{ Metronic::getSVG('media/svg/icons/General/User.svg', 'svg-icon svg-icon-2x') }}
                                </div>
                                <div class="wizard-label text-left">
                                    <h3 class="wizard-title">Personal Details</h3>
                                    <div class="wizard-desc">Patient Personal Details</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Wizard Step 1 Nav-->
                        <!--begin::Wizard Step 2 Nav-->
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-wrapper">
                                <div class="wizard-icon">
                                    {{ Metronic::getSVG('media/svg/icons/General/Lock.svg', 'svg-icon svg-icon-2x') }}
                                </div>
                                <div class="wizard-label text-left">
                                    <h3 class="wizard-title">Account Settings</h3>
                                    <div class="wizard-desc">Patient's Account related details</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Wizard Step 2 Nav-->
                        <!--begin::Wizard Step 3 Nav-->
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-wrapper">
                                <div class="wizard-icon">
                                    {{ Metronic::getSVG('media/svg/icons/General/Like.svg', 'svg-icon svg-icon-2x') }}
                                </div>
                                <div class="wizard-label text-left">
                                    <h3 class="wizard-title">Completed!</h3>
                                    <div class="wizard-desc">Review and, Save</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Wizard Step 3 Nav-->
                    </div>
                </div>
                <!--end: Wizard Nav-->
                <!--begin: Wizard Body-->
                <div class="wizard-body p-lg-20 p-md-5 p-sm-10">
                    <!--begin: Wizard Form-->
                    <form class="form" id="editPatientForm" action="{{ route('api.users.update', $user->uuid) }}" method="post">
                        <!--begin: Wizard Step 1-->
                        <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                            <h4 class="mb-10 font-weight-bold text-dark">Personal Details</h4>
                            @if(false)
                                {{-- ToDo: MVP-2 Enable Avatars --}}
                                <div class="form-group row">
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="image-input image-input-empty image-input-outline" id="kt_image_5" style="background-image: url({{ asset('media/users/blank.png')}})">
                                            <div class="image-input-wrapper"></div>
                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                            </label>
                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
                                        </div>
                                        <span class="form-text text-muted">We don't re ally need this.</span>
                                    </div>
                                </div>
                            @endif
                        <!--begin::Input-->
                            <label class="font-weight-bolder">RSA ID Number</label>
                            <div class="form-group text-left">
                                <input type="text" class="form-control form-control-solid form-control-lg" name="id_number" placeholder="RSA ID Number" value="{{ $user->profile->id_number ?? old('id_number') }}" />
                            </div>
                            <!--end::Input-->

                            <!--begin::Input-->

                            <label  class="font-weight-bolder">Date of Birth</label>
                            <div class="form-group text-left">
                                <input type="text" class="form-control form-control-solid form-control-lg" readonly name="date_of_birth" placeholder="Date of Birth" value="{{ $user->profile->date_of_birth->format('Y-m-d') ?? old('date_of_birth') }}" />
                            </div>
                            <!--end::Input-->

                            <div class="row">
                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                    <!--begin::Input-->
                                    <label  class="font-weight-bolder">First Name</label>
                                    <div class="form-group text-left">
                                        <input type="text" class="form-control form-control-solid form-control-lg" name="first_name" placeholder="First Name" value="{{ $user->profile->first_name ?? old('first_name') }}" />
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                    <!--begin::Input-->
                                    <label  class="font-weight-bolder">Last Name</label>
                                    <div class="form-group text-left">
                                        <input type="text" class="form-control form-control-solid form-control-lg" name="last_name" placeholder="Last Name" value="{{ $user->profile->last_name ?? old('last_name') }}" />
                                    </div>
                                    <!--end::Input-->
                                </div>
                            </div>

                            <!--begin::Input-->
                            <label  class="font-weight-bolder">Gender</label>
                            <div class="form-group text-left">
                                <div class="radio-inline text-left">
                                    <label class="radio">
                                        <input type="radio" name="gender" value="M" {{ $user->profile->gender == 'M' ?'checked':'' }}/> Male
                                        <span></span>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="gender" value="F" {{ $user->profile->gender == 'F' ?'checked':'' }}/> Female
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <!--end::Input-->

                            <!--begin::Input-->
                            <label  class="font-weight-bolder">Address</label>
                            <div class="form-group text-left">
                                <input type="text" class="form-control form-control-solid form-control-lg" name="address" placeholder="Street Address" value="{{ $user->profile->address ?? old('address') }}" />
                            </div>
                            <!--end::Input-->
                            <!--begin::Input-->
                            <label  class="font-weight-bolder">City</label>
                            <div class="form-group text-left">
                                <input type="text" class="form-control form-control-solid form-control-lg" name="city" placeholder="City" value="{{ $user->profile->city ?? old('city') }}" />
                            </div>
                            <!--end::Input-->
                            <div class="row">
                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                    <!--begin::Input-->

                                    <label  class="font-weight-bolder">Province</label>
                                    <div class="form-group text-left">
                                        {{ Form::select('province', \App\Region::$provinces, [ $user->profile->province ?? old('province') ], ['class' => 'form-control text-dark form-control-solid kt-selectpicker', 'data-size'=>'5', 'data-live-search'=>'true']) }}
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                    <!--begin::Input-->
                                    <label  class="font-weight-bolder">Postal Code</label>
                                    <div class="form-group text-left">
                                        <input type="text" class="form-control form-control-solid form-control-lg" name="postal_code" placeholder="Postal Code" value="{{ $user->profile->postal_code ?? old('postal_code') }}" />
                                    </div>
                                    <!--end::Input-->
                                </div>
                            </div>

                        </div>
                        <!--end: Wizard Step 1-->
                        <!--begin: Wizard Step 2-->
                        <div class="pb-5" data-wizard-type="step-content">
                            <h4 class="mb-10 font-weight-bold text-dark">Enter your Account Details</h4>

                            <!--begin::Form group-->
                            <label  class="font-weight-bolder">Cell Number</label>
                            <div class="form-group">
                                <input class="form-control form-control-solid form-control-lg" type="tel" placeholder="Cell Phone Number" name="cell_number" autocomplete="on" value="{{ $user->profile->cell_number ?? old('cell_number') }}"/>
                            </div>
                            <!--end::Form group-->

                            <!--begin::Form group-->
                            <label  class="font-weight-bolder">Email Address</label>
                            <div class="form-group text-left">
                                <input class="form-control form-control-solid form-control-lg" type="email" placeholder="Email" name="email" autocomplete="off" value="{{ $user->email ?? old('email') }}"/>
                            </div>
                            <!--end::Form group-->
                        </div>
                        <!--end: Wizard Step 2-->
                        <!--begin: Wizard Step 6-->
                        <div class="pb-5" data-wizard-type="step-content">
                            <!--begin::Section-->
                            <h4 class="mb-10 font-weight-bold text-dark text-left">Review your Details and Submit</h4>
                            <h6 class="font-weight-bolder mb-3 text-left">Personal Details:</h6>
                            <div class="text-dark-50 line-height-lg text-left">
                                <div><span id="UI_id_number"></span></div>
                                <div><span id="UI_first_name"></span></div>
                                <div><span id="UI_last_name"></span></div>
                                <div><span id="UI_gender"></span></div>
                                <div><span id="UI_date_of_birth"></span></div>
                                <div><span id="UI_address"></span></div>
                                <div><span id="UI_city"></span></div>
                                <div><span id="UI_province"></span></div>
                                <div><span id="UI_postal_code"></span></div>
                            </div>
                            <div class="separator separator-dashed my-5"></div>
                            <!--end::Section-->
                            <!--begin::Section-->
                            <h6 class="font-weight-bolder mb-3 text-left">Account Settings:</h6>
                            <div class="text-dark-50 line-height-lg text-left">
                                <div><span id="UI_email"></span></div>
                                <div><span id="UI_cell_number"></span></div>
                                <div><span id="UI_agree"></span></div>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end: Wizard Step 6-->
                        <!--begin: Wizard Actions-->
                        <div class="d-flex justify-content-between border-top mt-5 pt-10">
                            <div class="mr-2">
                                <button class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-prev">Previous</button>
                            </div>
                            <div>
                                <button class="btn btn-success font-weight-bold text-uppercase px-9 py-4" id="editDetailsSubmitButton" data-wizard-type="action-submit">Update Details</button>
                                <button class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-next">Next Step</button>
                            </div>
                        </div>
                        <!--end: Wizard Actions-->
                    </form>
                    <!--end: Wizard-->
                </div>
                <!--end: Wizard Body-->
            </div>
            <!--end: Wizard-->
        </div>

    </div>
    <!--end::Edit Details-->
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/wizard/wizard-2.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/backend/user/edit.js') }}"></script>
@endsection
