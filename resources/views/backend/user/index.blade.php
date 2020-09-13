@extends('layout.default')

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Patients</h3>
            </div>
        </div>
        <div class="card-body">

            <!--begin: Search Form-->
            <form class="kt-form kt-form--fit mb-15">
                <div class="row mb-6">
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>First Name:</label>
                        <input type="text" class="form-control datatable-input" placeholder="E.g: Thabile" data-col-index="0" />
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>Surname:</label>
                        <input type="text" class="form-control datatable-input" placeholder="E.g: Shabangu" data-col-index="1" />
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>Email Address:</label>
                        <input type="text" class="form-control datatable-input" placeholder="E.g: karabo88@example.com" data-col-index="2" />
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>Province:</label>
                        <select class="form-control datatable-input select-picker" data-col-index="4">
                            <option value="">Select</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province }}">{{ $province  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-lg-6 mb-lg-0 mb-6">
                        <label>Join Date:</label>
                        <div class="input-daterange input-group" id="kt_datepicker">
                            <input type="text" class="form-control datatable-input" name="start" placeholder="From" data-col-index="5" />
                            <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-ellipsis-h"></i>
                                    </span>
                            </div>
                            <input type="text" class="form-control datatable-input" name="end" placeholder="To" data-col-index="5" />
                        </div>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>Status:</label>
                        <select class="form-control datatable-input select-picker" data-col-index="6">
                            <option value="">Select</option>
                            <option value="0">Active</option>
                            <option value="1">Locked</option>
                        </select>
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
            <table
                class="table table-separate table-head-custom table-checkable datatable-head-custom table-head-bg datatable-head"
                id="users-table">
                <thead>
                <tr>
                    <th style="padding-left: 10px !important;">ID</th>
                    <th>Patient</th>
                    <th>Contact</th>
                    <th>Cell Number</th>
                    <th>Address</th>
                    <th>Joined</th>
                    <th>Locked</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('js/pages/backend/user/index.js') }}" type="text/javascript" defer></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}">
    <style>
        .datepicker {
            width: 320px;
        }
    </style>
@endsection

