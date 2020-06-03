@extends('layout.default')

@section('content')
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        Enter Status Details
                    </h3>
                    <div class="card-toolbar">
                        <div class="justify-content-center">
                            <a href="{{ route('statuses.index') }}" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <rect fill="#000000" x="2" y="4" width="19" height="4" rx="1"/>
                                        <path d="M3,10 L6,10 C6.55228475,10 7,10.4477153 7,11 L7,19 C7,19.5522847 6.55228475,20 6,20 L3,20 C2.44771525,20 2,19.5522847 2,19 L2,11 C2,10.4477153 2.44771525,10 3,10 Z M10,10 L13,10 C13.5522847,10 14,10.4477153 14,11 L14,19 C14,19.5522847 13.5522847,20 13,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M17,10 L20,10 C20.5522847,10 21,10.4477153 21,11 L21,19 C21,19.5522847 20.5522847,20 20,20 L17,20 C16.4477153,20 16,19.5522847 16,19 L16,11 C16,10.4477153 16.4477153,10 17,10 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>All Statuses</a>
                        </div>
                    </div>
                </div>
                <form method="post" class="form" id="statusCreateForm" data-action="{{route('statuses.store')}}">
                    <div class="card-body">
                        @include('backend.status._form')
                    </div>
                    <div class="card-footer bg-gray-100 border-top-0 text-right rounded-bottom">
                        <div class="row">
                            <div class="col-lg-9 ml-lg-auto">
                                <button id="submitForm" type="submit" class="btn btn-primary font-weight-bold mr-2">Save Status</button>
                                <button type="reset" class="btn btn-light-primary font-weight-bold">Reset Form</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/pages/crud/forms/widgets/bootstrap-switch.js') }}" type="text/javascript" defer></script>
    <script src="{{ mix('js/pages/backend/status/create.js') }}" type="text/javascript" defer></script>
@endsection

