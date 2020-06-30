<div class="row mb-10">
    <div class="col-lg-12">
        <div class="card card-custom">
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Make an Appointment</span>
                </h3>
                <div class="card-toolbar">
                </div>
            </div>
            <div class="card-body py-0">
                <div class="wizard wizard-3" id="kt_wizard_v2" data-wizard-state="step-first" data-wizard-clickable="false">
                    <!--begin: Wizard Nav-->
                    <div class="wizard-nav">
                        <div class="wizard-steps px-sm-5 px-md-8 py-8 px-lg-15 py-lg-3">
                            <!--begin::Wizard Step 1 Nav-->
                            <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                <div class="wizard-label">
                                    <h3 class="wizard-title">
                                        <span>1.</span>Appointment Details</h3>
                                    <div class="wizard-bar"></div>
                                </div>
                            </div>
                            <!--end::Wizard Step 1 Nav-->
                            <!--begin::Wizard Step 2 Nav-->
                            <div class="wizard-step" data-wizard-type="step">
                                <div class="wizard-label">
                                    <h3 class="wizard-title">
                                        <span>2.</span>Patient Details</h3>
                                    <div class="wizard-bar"></div>
                                </div>
                            </div>
                            <!--end::Wizard Step 2 Nav-->
                            <!--begin::Wizard Step 3 Nav-->
                            <div class="wizard-step" data-wizard-type="step">
                                <div class="wizard-label">
                                    <h3 class="wizard-title">
                                        <span>3.</span>Family Details</h3>
                                    <div class="wizard-bar"></div>
                                </div>
                            </div>
                            <!--end::Wizard Step 3 Nav-->
                            <!--begin::Wizard Step 3 Nav-->
                            <div class="wizard-step" data-wizard-type="step">
                                <div class="wizard-label">
                                    <h3 class="wizard-title">
                                        <span>4.</span>Review Details and Submit</h3>
                                    <div class="wizard-bar"></div>
                                </div>
                            </div>
                            <!--end::Wizard Step 3 Nav-->
                        </div>
                    </div>
                    <!--end: Wizard Nav-->
                    <!--begin: Wizard Body-->
                    <div class="wizard-body px-sm-5 px-lg-17 py-8 py-lg-6">
                        <!--begin: Wizard Form-->
                        <div class="row">
                            <div class="col-xxl-12">
                                <form class="form" id="registerPatientForm" method="post" action="{{ route('appointments.store') }}">
                                {{--@csrf--}}
                                <!--begin: Wizard Step 1-->
                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                        <!--begin::Section-->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="card card-stretch min-h-300px" id="datepicker-card">
                                                        <div class="card-body p-5">
                                                            <div class="datepicker"></div>
                                                            <span class="form-text text-muted pt-3">If all dates are not selectable, please load dates in the events section, or report the issue</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="appointment_type" class="font-weight-bolder">Select Appointment Date from Calendar:</label>
                                                    <input type="text" name="event_date" data-id="" class="form-control form-control-solid mb-5" value="" placeholder="" readonly/>
                                                    <span class="form-text text-info" id="limit_value"></span>
                                                </div>
                                                <div class="form-group">
                                                    <div class="radio-list">
                                                        <label for="appointment_type" class="font-weight-bolder">Select Appointment Type:</label>
                                                        <label class="radio">
                                                            <input type="radio" name="appointment_type" value="Cleansing"/>  Cleansing
                                                            <span></span>
                                                        </label>
                                                        <label class="radio">
                                                            <input type="radio" id="consultation_option" name="appointment_type" value="Consulting"/> Consultation
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end: Wizard Step 1-->
                                    <!--begin: Wizard Step 2-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <h4 class="mb-10 font-weight-bold text-dark">Enter the Patient's Details</h4>
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <!--begin::Input-->
                                                <div class="form-group ">
                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="id_number" placeholder="RSA ID Number" value="" />
                                                </div>
                                                <!--end::Input-->

                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-solid form-control-lg" readonly name="date_of_birth" placeholder="Date of Birth" value="" />
                                                </div>
                                                <!--end::Input-->

                                                <div class="row">
                                                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                        <!--begin::Input-->
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="first_name" placeholder="First Name" value="" />
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                        <!--begin::Input-->
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="last_name" placeholder="Last Name" value="" />
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>

                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <div class="radio-inline">
                                                        <label class="radio">
                                                            <input type="radio" name="gender" value="M"/> Male
                                                            <span></span>
                                                        </label>
                                                        <label class="radio">
                                                            <input type="radio" name="gender" value="F"/> Female
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-lg-3">
                                                <!--begin::Form group-->
                                                <div class="form-group">
                                                    <input class="form-control form-control-solid form-control-lg" type="email" placeholder="Email" name="email" autocomplete="off" />
                                                </div>
                                                <!--end::Form group-->
                                                <!--begin::Form group-->
                                                <div class="form-group">
                                                    <input class="form-control form-control-solid form-control-lg" type="tel" placeholder="Cell Phone Number" name="cell_number" autocomplete="on" value=""/>
                                                </div>
                                                <!--end::Form group-->
                                            </div>
                                            <div class="col-lg-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="address" placeholder="Street Address" value="" />
                                                </div>
                                                <!--end::Input-->
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="city" placeholder="City" value="" />
                                                </div>
                                                <!--end::Input-->
                                                <div class="row">
                                                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                        <!--begin::Input-->
                                                        <div class="form-group">
                                                            {{ Form::select('province', $provinces, null, ['class' => 'form-control text-dark form-control-solid kt-selectpicker']) }}
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                        <!--begin::Input-->
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="postal_code" placeholder="Postal Code" value="" />
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Wizard Step 2-->
                                    <!--begin: Wizard Step 3-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <h4 class="mb-10 font-weight-bold text-dark">Setup the Patient's Family Account</h4>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="with_family" value="Yes"/> The Appointment is for a Family
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <!--end::Input-->
                                                <!--begin::Input-->
                                                <div class="form-group animated" style="display: none">
                                                    <label>Family Name</label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="family_name" placeholder="Enter the Family Name" value="" disabled="disabled"/>
                                                    <span class="help-block text-success">Other members of the family can only be added by the creator of the Family Account.</span>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Wizard Step 3-->
                                    <!--begin: Wizard Step 4-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <h4 class="mb-10 font-weight-bold text-dark">Review Patient Details and Submit</h4>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Field</th>
                                                        <th scope="col">Value</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="review_info">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Wizard Step 4-->
                                    <!--begin: Wizard Actions-->
                                    <div class="d-flex justify-content-between pb-10">
                                        <div class="mr-2">
                                            <button class="btn btn-light-primary font-weight-bold text-uppercase font-weight-bolder" data-wizard-type="action-prev">Previous</button>
                                        </div>
                                        <div>
                                            <button id="make_appointment" class="btn btn-success font-weight-bold text-uppercase font-weight-bolder" data-wizard-type="action-submit">Submit</button>
                                            <button id="next_step" class="btn btn-primary font-weight-bold text-uppercase font-weight-bolder" data-wizard-type="action-next">Next Step</button>
                                        </div>
                                    </div>
                                    <!--end: Wizard Actions-->
                                </form>
                            </div>
                            <!--end: Wizard-->
                        </div>
                    </div>
                    <!--end: Wizard Body-->

                </div>
            </div>
        </div>

    </div>
</div>
