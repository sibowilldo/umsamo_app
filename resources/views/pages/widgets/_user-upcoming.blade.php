    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Upcoming Appointments</span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span>
            </h3>
            <div class="card-toolbar">
                <a href="#" class="btn btn-info font-weight-bolder font-size-sm mr-3">New Report</a>
                <a href="#" class="btn btn-danger font-weight-bolder font-size-sm">Create</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0 pb-3">
            <div class="tab-content">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                        <thead>
                        <tr class="text-left text-uppercase">
                            <th style="min-width: 250px" class="pl-7">
                                <span class="text-dark-75">Event</span>
                            </th>
                            <th style="min-width: 100px">Region</th>
                            <th style="min-width: 100px">Status</th>
                            <th style="min-width: 100px">Reserved Date</th>
                            <th style="min-width: 80px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td class="pl-0 py-8">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50 symbol-light mr-4">
                                        <span class="symbol-label">
                                            <img src="{{asset('media/svg/avatars/001-boy.svg')}}" class="h-75 align-self-end" alt="">
                                        </span>
                                    </div>
                                    <div>
                                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $appointment->event->title }}</a>
                                        <span class="text-muted font-weight-bold d-block">HTML, JS, ReactJS</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">$8,000,000</span>
                                <span class="text-muted font-weight-bold">In Proccess</span>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">$520</span>
                                <span class="text-muted font-weight-bold">Paid</span>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Intertico</span>
                                <span class="text-muted font-weight-bold">Web, UI/UX Design</span>
                            </td>
                            <td class="pr-0 text-right">
                                <a href="#" class="btn btn-light-success font-weight-bolder font-size-sm">View Details</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end::Table-->
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Advance Table Widget 4-->
