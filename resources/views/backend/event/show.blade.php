@extends('layout.default')

@section('content')
    <!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="d-flex">
                <!--begin: Pic-->
                <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                    <div class="symbol symbol-50 symbol-lg-150">
                        <img src="{{ Avatar::create($event->title)->toBase64() }}" alt="{{ $event->title }}"/>
                    </div>
                </div>
                <!--end: Pic-->
                <!--begin: Info-->
                <div class="flex-grow-1">
                    <!--begin: Title-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="mr-3">
                            <!--begin::Name-->
                            <p class="d-flex align-items-center text-dark font-size-h5 font-weight-bold mr-3">{{ $event->title }}</p>
                            <!--end::Name-->
                        </div>
                        <div class="my-lg-0 my-1">
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3">Edit Details</a>
                            <a href="{{ route('events.index') }}" class="btn btn-sm btn-info font-weight-bolder text-uppercase">All Events</a>
                        </div>
                    </div>
                    <!--end: Title-->
                    <!--begin: Content-->
                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                        <div class="flex-grow-1 font-weight-bold text-dark-50 py-5 py-lg-2 mr-5">
                            {{ $event->description }}
                        </div>
                        <div class="d-flex flex-wrap align-items-left py-2">
                            <div class="d-flex align-items-center mr-0">
                                <div class="mr-6">
                                    <div class="font-weight-bold mb-2">Created Date</div>
                                    <span class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">{{ $event->created_at }}</span>
                                </div>
                                <div class="">
                                    <div class="font-weight-bold mb-2">Last Updated</div>
                                    <span class="btn btn-sm btn-text btn-light-danger text-uppercase font-weight-bold">{{ $event->updated_at->diffForhumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end: Content-->
                </div>
                <!--end: Info-->
            </div>
            <!--begin: Items-->
        </div>
    </div>
    <!--end::Card-->
    <!--begin::Row-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Advance Table Widget 3-->
            <div class="card card-custom card-stretch gutter-b min-h-650px">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Event Dates in this Event</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">{{ count($event->event_dates) }} event dates</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-0 pb-3">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                            <thead>
                            <tr class="text-uppercase">
                                <th style="min-width: 250px" class="pl-7">
                                    <span class="text-dark-75">Date</span>
                                </th>
                                <th style="min-width: 130px">status</th>
                                <th style="min-width: 100px">Limit</th>
                                <th style="min-width: 100px">Appointments</th>
                                <th style="min-width: 120px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($event->event_dates as $event_date)
                            <tr>
                                <td class="pl-0 py-8">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50 flex-shrink-0 mr-4">
                                            <div class="symbol-label" style="background-image: url('{{Avatar::create($event->title)->toBase64() }}')">

                                            </div>
                                        </div>
                                        <div>
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $event_date->date_time->format('M d, Y') }}</a>
                                            <span class="text-muted font-weight-bold d-block">{{ $event_date->date_time->shortRelativeToNowDiffForHumans() }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $event_date->status->title }}</span>
                                    <span class="text-muted font-weight-bold"></span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">$520</span>
                                    <span class="text-muted font-weight-bold">Paid</span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Bradly Beal</span>
                                    <span class="text-muted font-weight-bold">Insurance</span>
                                </td>
                                <td class="text-right pr-0">
                                    <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
                                        {{ Metronic::getSvg('media/svg/icons/General/Bookmark.svg', 'svg-icon svg-icon-md svg-icon-primary') }}
                                    </a>
                                    <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                        {{ Metronic::getSvg('media/svg/icons/Navigation/Arrow-right.svg', 'svg-icon svg-icon-md svg-icon-primary') }}
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                            @empty
                            @endforelse
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Advance Table Widget 3-->
        </div>
    </div>
    <!--end::Row-->
@endsection

@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Laravolt" rel="stylesheet">
@endsection

@section('scripts')

@endsection

