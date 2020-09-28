@extends('layout.default')

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">{{ $page_title }} list</h3>
            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
            <form class="kt-form kt-form--fit mb-15">
                <div class="row mb-6">
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>Reference:</label>
                        <input type="text" class="form-control datatable-input" placeholder="E.g: SLF-000-AB12"
                               data-col-index="0"/>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>Email Address:</label>
                        <input type="email" class="form-control datatable-input" placeholder="E.g: karabo88@example.com"
                               data-col-index="6"/>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>Type:</label>
                        <select class="form-control datatable-input filter-select" data-col-index="2" data-placeholder="Select">
                            <option value="">Select</option>
                            <option value="{{ \App\Appointment::TYPE_CONSULTING }}">Consulting</option>
                            <option value="{{ \App\Appointment::TYPE_CLEANSING }}">Cleansing</option>
                        </select>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>Status:</label>
                        <select id="filter-status" class="form-control datatable-input filter-select" data-col-index="4"  data-placeholder="Select">
                            <option value="">Select</option>
                            @foreach($statuses as $status)
                                <option value="{{$status->id}}">{{ $status->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-lg-6 mb-lg-0 mb-6">
                        <label>Scheduled Between:</label>
                        <div class="input-daterange input-group" id="kt_datepicker">
                            <input type="text" class="form-control datatable-input" name="start" placeholder="From"
                                   data-col-index="1"/>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-ellipsis-h"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control datatable-input" name="end" placeholder="To"
                                   data-col-index="1"/>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <div class="row mt-8">
                            <div class="col-lg-12">
                                <button class="btn btn-primary btn-primary--icon" id="kt_search">
                                <span>
                                    <i class="la la-search"></i>
                                    <span>Search</span>
                                </span>
                                </button>&#160;&#160;
                                <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                                <span>
                                    <i class="la la-close"></i>
                                    <span>Reset</span>
                                </span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <!--begin: Datatable-->
        {!! $dataTable->table() !!}
        <!--end: Datatable-->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js')}}"></script>
    <script src="{{ asset('js/pages/backend/admin/appointments.js') }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}">
    <style>
        .datepicker {
            width: 320px;
        }
    </style>
@endsection

