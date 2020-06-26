<div class="row mb-10">
    <div class="col-lg-12">
        <div class="card card-custom">
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
                                        <span>2.</span>Family Details</h3>
                                    <div class="wizard-bar"></div>
                                </div>
                            </div>
                            <!--end::Wizard Step 2 Nav-->
                            <!--begin::Wizard Step 3 Nav-->
                            <div class="wizard-step" data-wizard-type="step">
                                <div class="wizard-label">
                                    <h3 class="wizard-title">
                                        <span>3.</span>Review Details and Submit</h3>
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
                                <form class="form" id="makeAppointment" method="post" action="{{ route('appointments.store') }}">
                                {{--@csrf--}}
                                <!--begin: Wizard Step 1-->
                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                        <!--begin::Section-->
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <div class="card card-stretch min-h-300px" id="datepicker-card">
                                                        <div class="card-body p-5">
                                                            <div class="datepicker"></div>
                                                            <span class="form-text text-muted pt-3">If all dates are not selectable, please check again next Monday.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="appointment_type" class="font-weight-bolder">Select Appointment Date from Calendar:</label>
                                                    <input type="text" name="event_date" data-id="" class="form-control form-control-solid mb-5" value="" placeholder="" readonly/>
                                                    <span class="form-text text-success" id="limit_value"></span>
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
                                                @if(count($families))
                                                    <!--begin::Input-->
                                                        <div class="form-group animated" style="display: none">
                                                            <label>Family Name</label>

                                                            <select name="family_name" id="family_name" class="kt-selectpicker form-control form-control-solid form-control-lg">

                                                                @foreach($families as $family)
                                                                    <option value="{{ $family->name }}">{{ $family->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="help-block text-success">Other members of the family can only be added by the creator of the Family Account.</span>
                                                        </div>
                                                        <!--end::Input-->
                                                @else
                                                    <!--begin::Input-->
                                                    <div class="form-group animated" style="display: none">
                                                        <label>Family Name</label>
                                                        <input id="family_name" type="text" class="form-control form-control-solid form-control-lg" name="family_name" placeholder="Enter the Family Name" value="" disabled="disabled"/>
                                                        <span class="help-block text-success">Other members of the family can only be added by the creator of the Family Account.</span>
                                                    </div>
                                                    <!--end::Input-->
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Wizard Step 2-->
                                    <!--begin: Wizard Step 3-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <h4 class="mb-10 font-weight-bold text-dark">Review Details and Submit</h4>
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
                                    <!--end: Wizard Step 3-->
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
