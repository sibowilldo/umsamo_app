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
                        @csrf
                        <!--begin: Wizard Step 1-->
                            <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                <!--begin::Section-->
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <div class="card card-stretch min-h-300px" id="datepicker-card">
                                                <div class="card-body p-5">
                                                    <div class="datepicker"></div>
                                                    <span class="form-text text-muted pt-3">If all dates are not selectable, Please check again next Month.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="appointment_type" class="font-weight-bolder">Choose a date from the Calendar:</label>
                                            <input type="text" name="event_date" data-id="" class="form-control form-control-solid mb-5" value="" placeholder="" readonly/>
                                            <span class="form-text text-success" id="limit_value"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_type" class="font-weight-bolder">
                                                Choose Appointment Type:
                                            </label>
                                            <select name="appointment_type" id="appointment_type" class="form-control text-dark form-control-solid kt-selectpicker" title="Choose one of the following...">
                                                @foreach($appointment_types as $type)
                                                    <option value="{{ $type['id'] }}" {{ $type['id'] == 1 ? 'disabled':'' }} data-value="{{ $type['title'] }}" data-subtext="{{ $type['id'] == 1 ? 'DISABLED: Currently Unavailable':'' }}">
                                                        {{ $type['title'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-custom alert-notice alert-primary fade show rounded d-none mb-10 animated" role="alert" id="consultation-full-message">
                                            <div class="alert-icon">{{ Metronic::getSVG('media/svg/icons/Code/Info-circle.svg', 'svg-icon svg-icon-light svg-icon-2x') }}</div>
                                            <div class="alert-text"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end: Wizard Step 1-->
                            <!--begin: Wizard Step 2-->
                            <div class="pb-5" data-wizard-type="step-content">
                                <h4 class="font-weight-bold text-dark">Choose Family members</h4>
                                <span class="text-muted form-text mb-10 ">If you are making this appointment only for yourself, please skip this step.</span>
                                <div class="row">
                                    <div class="col-xl-6 {{ count($members) ? '': 'd-none'}}">
                                    <!--begin::Input-->
                                        <div class="form-group">
                                            <label class="checkbox">
                                                <input type="checkbox" name="with_family" value="Yes"/> The Appointment is for a Family
                                                <span></span>
                                            </label>
                                        </div>
                                        <!--end::Input-->
                                    <!--begin::Input-->
                                        <div class="form-group radio-inline d-none family_container">
                                            <label class="font-weight-bolder d-block">Preferred Family</label>
                                            @foreach($user->families as $family)
                                                    <label class="radio {{ count($family->users) > 1?:'radio-disabled' }}">
                                                        <input type="radio" name="family" value="{{ $family->id }}" {{ count($family->users) > 1?:'disabled' }} data-family-name="{{ $family->name }}"/> <strong>{{ $family->name }}</strong> {{ count($family->users) > 1?'':'(To Enable, please invite members to Join.)' }}
                                                        <span></span>
                                                    </label>
                                            @endforeach
                                        </div>
                                        <!--end::Input-->
                                    <!--begin::Input-->
                                        <div class="form-group family_container d-none">
                                            <label class="font-weight-bolder">Select Family Members</label>
                                            <select multiple title="Select Family Members" name="family_member" id="family_member" class="kt-selectpicker form-control form-control-solid form-control-lg" data-live-search="true">
                                            @foreach($user->families as $family)
                                                <optgroup label="{{ $family->name }} ({{ $family->users_count-1 }} other {{ $family->users_count===1?'member':'members' }})">
                                                    @foreach($family->users as $member)
                                                        @if($member->id !== $user->id)
                                                        <option  value="{{ $member->uuid }}">{{ $member->profile->fullname }}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                            </select>
                                            <span class="help-block text-success"></span>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    @if(!count($members))
                                        <div class="col-xl-8">
                                            <!--begin::Alert-->
                                            <div class="alert alert-custom alert-outline-danger fade show shadow-xs" role="alert">
                                                <div class="alert-icon">{{ Metronic::getSvg('media/svg/icons/Code/Warning-2.svg', 'svg-icon-3x svg-icon svg-icon-danger') }}</div>
                                                <div class="alert-text text-dark-75">Your Account is not associated with any Family Accounts. Please create one from the Profile page, before you try to make an Appointment for a Family.</div>
                                            </div>
                                            <!--end::Alert-->
                                        </div>
                                    @endif
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
