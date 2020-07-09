<!--begin::Appointments Widget-->
<div class="card card-custom {{ @$class }}">
    <div class="card-header">
        <h3 class="card-title">
            <span class="card-label font-weight-bolder text-dark">Today's Appointments</span>
        </h3>
        <div class="card-toolbar">
            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline mr-2">
                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="svg-icon svg-icon-md">
                    {{ Metronic::getSvg('media/svg/icons/Design/PenAndRuller.svg') }}
                </span>Export
                </button>
                <!--begin::Dropdown Menu-->
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                    <!--begin::Navigation-->
                    <ul class="navi flex-column navi-hover py-2">
                        @if(count($appointments))
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                Choose an option:
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link d-none">
                                <span class="navi-icon">
                                    <i class="flaticon2-print"></i>
                                </span>
                                    <span class="navi-text">Print</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="{{ route('print.appointments.today') }}" class="navi-link">
                                <span class="navi-icon">
                                    <i class="far fa-file-pdf"></i>
                                </span>
                                    <span class="navi-text">PDF (Not Possible)</span>
                                </a>
                            </li>
                        @else
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-danger pb-2">
                                No action possible
                            </li>
                        @endif
                    </ul>
                    <!--end::Navigation-->
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <!--end::Dropdown-->
        </div>
    </div>
    <div class="card-body">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                <thead>
                <tr>
                    <th data-field="reference">REFERENCE</th>
                    <th data-field="scheduledBy">SCHEDULED BY</th>
                    <th data-field="status">STATUS & TYPE</th>
                    <th>CONTACT</th>
                    <th class="text-right" data-field="action"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($appointments as $appointment)
                    @if(class_basename($appointment->appointmentable_type) == 'User')
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="bullet bullet-bar bg-{{ $appointment->status->color }} align-self-stretch pb-10 mr-4"></span>
                                    <div class="font-weight-bolder">{{ $appointment->reference }} <span
                                            class="font-size-xs text-muted text-uppercase d-block">{{ class_basename($appointment->appointmentable)}} Appointment</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                        <img class="" src="{{ $appointment->appointmentable->profile->avatar_url }}" alt="{{$appointment->appointmentable->profile->fullname}}"></div>
                                    <div class="ml-4">
                                        <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">
                                            {{ $appointment->appointmentable->profile->fullname }}
                                        </div>
                                        <span class="text-muted font-weight-bold">
                                            {{ $appointment->appointmentable->profile->id_number }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                        <span>
                            <span
                                class="label label-inline label-lg font-weight-bolder label-light-{{ $appointment->status->color }}">
                        {{ $appointment->status->title }}</span>
                            <div class="text-muted font-weight-bold">{{ $appointment->type }}</div>
                        </span>
                            </td>
                            <td>
                                <div>
                                    <span class="font-weight-bolder d-block">
                                        {{ $appointment->appointmentable->profile->cell_number }}
                                    </span>
                                    <span class="text-muted font-size-sm">
                                        {{ $appointment->appointmentable->email }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-end"
                                     aria-label="Available Actions">
                                    <a href="{{ route('appointments.show', $appointment->uuid) }}"
                                       class="btn btn-light btn-icon btn-sm" data-toggle="tooltip"
                                       title="View Details">
                                        {{ Metronic::getSVG('media/svg/icons/Navigation/Arrow-right.svg', 'svg-icon svg-icon-md svg-icon-primary') }}

                                    </a>
                                </div>
                            </td>
                        </tr>
                    @elseif(class_basename($appointment->appointmentable_type) == 'Family')
                        @foreach( $appointment->familyAppointments as $family_appointment )
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="bullet bullet-bar bg-{{ $appointment->status->color }} align-self-stretch pb-10 mr-4"></span>
                                        <div class="font-weight-bolder">{{ $appointment->reference }} <span
                                                class="font-size-xs text-muted text-uppercase d-block">{{ $appointment->appointmentable->name}}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                            <img class="" src="{{ $family_appointment->user->profile->avatar_url }}" alt="{{ $family_appointment->user->profile->fullname }}"></div>
                                        <div class="ml-4">
                                            <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">
                                                {{ $family_appointment->user->profile->fullname }}
                                            </div>
                                            <span class="text-muted font-weight-bold">
                                            {{ $family_appointment->user->profile->id_number }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                        <span>
                            <span
                                class="label label-inline label-lg font-weight-bolder label-light-{{ $family_appointment->status->color }}">
                        {{ $family_appointment->status->title }}</span>
                            <div class="text-muted font-weight-bold">{{ $appointment_types->where('id', $appointment->type )->first()['title']}}</div>
                        </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                        <span
                                            class="text-dark-75 d-block font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                            {{ $family_appointment->user->profile->cell_number }}
                                        </span>
                                            <span class="text-muted font-size-sm">
                                            {{ $family_appointment->user->email }}
                                        </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-end"
                                         aria-label="Available Actions">
                                        <a href="{{ route('appointments.show', $appointment->uuid) }}"
                                           class="btn btn-light btn-icon btn-sm" data-toggle="tooltip"
                                           title="View Details">
                                            {{ Metronic::getSVG('media/svg/icons/Navigation/Arrow-right.svg', 'svg-icon svg-icon-md svg-icon-primary') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
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
                                                There are no appointments found!
                                            </h4>
                                            <div class="text-muted">
                                                It seems there are no appointments scheduled for today so far,
                                                <br> Please check again later.
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
