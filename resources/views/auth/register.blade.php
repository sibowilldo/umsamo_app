@extends('layout.auth.auth-classic-2')


@section('content')
    <!--begin::Signup-->
    <h3 class="font-weight-bold text-dark display5"><span class="d-block text-dark-75 font-weight-boldest">Sign up for an account</h3>

    <p class="font-weight-bolder font-size-h5 align-right text-muted">Already have one? <a href="{{ route('login') }}">Sign in</a></p>
    <div class="">
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
                                <div class="wizard-desc">Let us know who you are</div>
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
                                <div class="wizard-desc">Setup Your Account Details</div>
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
                                <div class="wizard-desc">Review and, Submit</div>
                            </div>
                        </div>
                    </div>
                    <!--end::Wizard Step 3 Nav-->
                </div>
            </div>
            <!--end: Wizard Nav-->
            <!--begin: Wizard Body-->
            <div class="wizard-body px-8 py-lg-5 px-lg-10 pt-sm-10 pt-md-10 py-md-10 ">
                <!--begin: Wizard Form-->
                        <form class="form" id="registerForm" data-action="{{ route('register') }}" method="post">
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

                                @include('pages.widgets.auth.register._personal-details')
                            </div>
                            <!--end: Wizard Step 1-->
                            <!--begin: Wizard Step 2-->
                            <div class="pb-5" data-wizard-type="step-content">
                                <h4 class="mb-10 font-weight-bold text-dark">Enter your Account Details</h4>

                                <!--begin::Form group-->
                                <div class="form-group">
                                    <input class="form-control form-control-solid form-control-lg" type="tel" placeholder="Cell Phone Number" name="cell_number" autocomplete="on" value=""/>
                                    <span class="form-text text-muted">We'll never share your cell phone number with anyone else.</span>
                                </div>
                                <!--end::Form group-->

                            @include('pages.widgets.auth.register._account-settings')

                            <!--begin::Form group-->
                                <div class="form-group">
                                    <label class="checkbox mb-0">
                                        <input type="checkbox" name="agree" />I agree to the
                                        <a href="https://umsamo.org.za/" target="_blank">terms and conditions</a>.
                                        <span></span></label>
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
                                    <button class="btn btn-success font-weight-bold text-uppercase px-9 py-4" id="registerSubmitButton" data-wizard-type="action-submit">Submit</button>
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

    <!--end::Signup-->
@endsection

@section('styles')
    <style>
        @import '{{ asset('css/pages/wizard/wizard-2.css') }}';
    </style>
@endsection

@section('scripts')

    <!-- Include zxcvbn library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script src="{{ asset('plugins/custom/formvalidation/plugins/PasswordStrength.js') }}"></script>
    <script src="{{ asset('js/pages/auth/register.js') }}"></script>
@endsection

