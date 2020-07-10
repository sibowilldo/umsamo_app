    <!--begin::Appointments Widget-->
    <div class="card card-custom {{ @$class }}">
        <div class="card-header">
            <h3 class="card-title">
                    <span class="card-label font-weight-bolder text-dark">Upcoming Appointments</span>
            </h3>
            <div class="card-toolbar">
                <ul class="nav nav-light-primary nav-bold nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#upcoming_appointments_tab">
                            <span class="nav-icon">{{ Metronic::getSVG('media/svg/icons/General/User.svg') }}</span>
                            <span class="nav-text">My Appointments</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#family_upcoming_appointments_tab">
                            <span class="nav-icon">{{ Metronic::getSVG('media/svg/icons/Communication/Group.svg') }}</span>
                            <span class="nav-text">Family Appointments</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <button  type="button" class="btn btn-clean" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="nav-icon"><i class="ki ki-bold-more-ver"></i></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <a class="dropdown-item" data-toggle="tab" href="{{ route('appointments.index') }}">My Appointments</a></a>
                            <a class="dropdown-item" data-toggle="tab" href="#kt_tab_pane_4_3">Family Appointments</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="upcoming_appointments_tab" role="tabpanel" aria-labelledby="upcoming_appointments_tab">

                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                            <thead>
                            <tr class="text-left text-uppercase">
                                <th class="pl-7 w-200px">
                                    <span class="text-dark-75">Scheduled For</span>
                                </th>
                                <th>Status</th>
{{--                                <th class="w-150px">Appointment Type</th>--}}
                                <th>Scheduled</th>
                                <th style="min-width: 80px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($appointments as $appointment)
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
{{--                                    <td>--}}
{{--                                        <span class="text-muted font-weight-bold">{{ $appointment_types->where('id', $appointment->type )->first()['title']}}</span></td>--}}
{{--                                    <td>--}}
                                        <span class="text-muted font-weight-bold">{{ $appointment->created_at->diffForHumans() }}</span>
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
                <div class="tab-pane fade" id="family_upcoming_appointments_tab" role="tabpanel" aria-labelledby="family_upcoming_appointments_tab">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                            <thead>
                            <tr class="text-left text-uppercase">
                                <th class="pl-7">
                                    <span class="text-dark-75">Scheduled For</span>
                                </th>
                                <th>Status</th>
{{--                                <th>Appointment Type</th>--}}
                                <th>Reserved</th>
                                <th style="min-width: 80px"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($family_appointments as $appointment)
                                    <tr>
                                        <td class="pl-3 py-8">
                                            <div class="d-flex align-items-center">
                                                <span class="bullet bullet-bar bg-{{ $appointment->status->color }} align-self-stretch pb-10 mr-4"></span>
                                                <div>
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $appointment->appointment->event_date->date_time->format('D M d, Y') }}</a>
                                                    <span class="text-muted font-weight-bold d-block">{{ $appointment->appointment->event_date->date_time->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                        <span>
                                            <span class="label label-inline label-lg font-weight-bolder label-light-{{ $appointment->status->color }}">
                                        {{ $appointment->status->title }}</span>
                                        </span>
                                        </td>
{{--                                        <td>--}}
{{--                                            <span class="text-muted font-weight-bold">{{ $appointment_types->where('id', $appointment->type )->first()['title']}}</span></td>--}}
                                        <td>
                                            <span class="text-muted font-weight-bold">{{ $appointment->created_at->diffForHumans() }}</span>
                                        </td>
                                        <td class="pr-0 text-right">
                                            <a href="{{ route('appointments.show', $appointment->appointment->uuid) }}" class="btn btn-success font-weight-bolder font-size-sm">View Details</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
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
        </div>
    </div>
