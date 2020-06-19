    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch min-h-550px gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Your Upcoming Appointments</span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm">Showing 5 of {{ count($appointments) }} upcoming appointment{{count($appointments)==1? '':'s'}}</span>
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('appointments.index') }}" class="btn btn-light-info font-weight-bolder font-size-sm mr-3">View All Appointments</a>
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
                            <th class="pl-7">
                                <span class="text-dark-75">Appointment</span>
                            </th>
                            <th>Status</th>
                            <th>Reserved</th>
                            <th>Event</th>
                            <th style="min-width: 80px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($appointments->where('event_date.date_time', '>=', now())->sortBy('event_date.date_time')->take(5) as $appointment)
                            <tr>
                        <td class="pl-3 py-8">
                            <div class="d-flex align-items-center">
                                <span class="bullet bullet-bar bg-{{ $appointment->status->color }} align-self-stretch pb-10 mr-4"></span>
                                <div>
                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $appointment->event_date->date_time->format('D M d, Y') }}</a>
                                    <span class="text-muted font-weight-bold d-block">{{ $appointment->event_date->date_time->diffForHumans() }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                        <span>
                            <span class="label label-inline label-lg font-weight-bolder label-light-{{ $appointment->status->color }}">
                        {{ $appointment->status->title }}</span>
                        </span>
                        </td>
                        <td>
                            <span class="text-muted font-weight-bold">{{ $appointment->created_at->diffForHumans() }}</span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $appointment->event_date->event->title }}</span>
                            <div class="text-muted font-weight-bold">
                                <span class="label label-dot label-{{ $appointment->event_date->event->status->color }}"></span> {{ $appointment->event_date->event->status->title }}</div>
                        </td>
                        <td class="pr-0 text-right">
                            <a href="{{ route('appointments.show', $appointment->uuid) }}" class="btn btn-success font-weight-bolder font-size-sm">View Details</a>
                        </td>
                    </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="card border-0 card-stretch mb-8 mb-lg-0">
                                        <div class="card-body">
                                            <div class="d-flex min-h-350px align-items-center p-5">
                                                <div class="mr-6">
                                                    <span class="svg-icon svg-icon-info svg-icon-10x">
                                                     {{ Metronic::getSVG("media/svg/icons/Code/Warning-1-circle.svg") }}
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h4 class="text-dark font-weight-boldest font-size-h4 mb-3">
                                                        You don't have any upcoming appointments
                                                    </h4>
                                                    <div class="text-muted">
                                                        It seems you do not have any upcoming appointments,
                                                        <br> If you think this is in error, please contact us so we can investigate
                                                        <br>and correct the error.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!--end::Table-->
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Advance Table Widget 4-->
