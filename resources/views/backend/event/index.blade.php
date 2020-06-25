@extends('layout.default')

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Events</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Metronic::getSvg('media/svg/icons/Design/PenAndRuller.svg', 'svg-icon svg-icon-md') }}>Export</button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Navigation-->
                        <ul class="navi flex-column navi-hover py-2">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="flaticon2-print"></i>
                                </span>
                                    <span class="navi-text">Print</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="far fa-file-pdf"></i>
                                </span>
                                    <span class="navi-text">PDF</span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                    <!--end::Dropdown Menu-->
                </div>
                <!--end::Dropdown-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                    <span>
                                    <i class="flaticon2-search-1 text-muted"></i>
                                </span>
                                </div>
                            </div>
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label for="kt_datatable_search_status" class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                    <select class="form-control" id="kt_datatable_search_status">
                                        <option value="">All</option>
                                        @foreach($statuses as $status)
                                        <option value="{{ $status->title }}">{{ $status->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Search Form-->
            <!--end: Search Form-->
            <!--begin: Datatable-->
            <table class="table table-head-bg table-borderless table-head-custom" id="kt_datatable">
                <thead>
                <tr>
                    <th>EVENT DETAILS</th>
                    <th>STATUS</th>
                    <th>TYPE</th>
                    <th>RESERVED</th>
                    <th class="text-right">ACTION</th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td class="pl-3 py-8">
                            <div class="d-flex align-items-center">
                                <span class="bullet bullet-bar bg-{{ $event->status->color }} align-self-stretch pb-10 mr-4"></span>
                                <div>
                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $event->title}}</a>
                                    <span class="text-muted d-block">{{ $event->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                        <span>
                            <span class="label label-inline label-lg font-weight-bolder label-light-{{ $event->status->color }}">
                        {{ $event->status->title }}</span>
                        </span>
                        </td>
                        <td>
                           <span class="text-muted font-weight-bold"> </span>
                        </td>
                        <td>
                            <span class="text-muted font-weight-bold">{{ $event->created_at }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center justify-content-end" aria-label="Available Actions">
                                <a href="{{ route('events.show', $event->uuid) }}" class="btn btn-light btn-hover-primary btn-sm" data-toggle="tooltip" title="View Details">
                                    {{ Metronic::getSVG('media/svg/icons/General/Settings-1.svg', 'svg-icon svg-icon-md svg-icon-primary') }} View
                                </a>
                                @if(!$event->status->cancelled)
                                <button type="button" class="btn btn-light btn-hover-danger btn-sm deleteBtn ml-3" data-url="{{route('events.destroy', $event->uuid)}}" data-record="{{ $event->uuid }}" data-placement="top"  data-toggle="tooltip" data-original-title="Cancel Event">
                                   {{ Metronic::getSVG('media/svg/icons/Code/Stop.svg', 'svg-icon svg-icon-md svg-icon-danger') }}<span class="ml-1">Cancel</span>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
@endsection

@section('scripts')
{{--    <script src="{{ mix('js/pages/backend/event/index.js') }}" type="text/javascript" defer></script>--}}
@endsection

@section('styles')
@endsection

