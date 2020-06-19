@extends('layout.default')

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Regions</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Metronic::getSVG('media/svg/icons/Design/PenAndRuller.svg', 'svg-icon svg-icon-md') }} Export</button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Navigation-->
                        <ul class="navi flex-column navi-hover py-2">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-print"></i>
                                </span>
                                    <span class="navi-text">Print</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-copy"></i>
                                </span>
                                    <span class="navi-text">Copy</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-excel-o"></i>
                                </span>
                                    <span class="navi-text">Excel</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-text-o"></i>
                                </span>
                                    <span class="navi-text">CSV</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-pdf-o"></i>
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
                <!--begin::Button-->
                <a href="{{ route('regions.create') }}" class="btn btn-primary font-weight-bolder">
                    {{ Metronic::getSVG('media/svg/icons/Design/Flatten.svg', 'svg-icon svg-icon-md') }} New Record</a>
                <!--end::Button-->
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
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Search Form-->
            <!--end: Search Form-->
            <!--begin: Datatable-->
            <table class="table table-head-bg table-head-custom" id="kt_datatable">
                <thead>
                <tr class="border-0">
                    <th title="Field #1"><div class="text-muted">REGION</div></th>
                    <th title="Field #3"><div class="text-muted">LOCATION DETAILS</div></th>
                    <th title="Field #4"><div class="text-muted">CREATED</div></th>
                    <th title="Field #6" class="text-right"><div class="text-muted">ACTION</div></th>
                </tr>
                </thead>
                <tbody>
                @foreach($regions as $region)
                    <tr>
                        <td>
                            <div class="font-weight-bolder mb-0">{{ $region->name }}</div>
                            <div class="text-muted font-weight-bold">{{ $region->contact_number }}</div>
                        </td>
                        <td>
                            <div class="font-weight-bolder mb-0">{{ $region->province }}</div>
                            <div class="text-muted">{{ $region->address }}</div>
                        </td>
                        <td>{{ $region->created_at }}</td>
                        <td class="pr-0 text-right">
                            <div>
                                <a href="{{ route('regions.show', $region->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-toggle="tooltip" title="View Details">
                                    {{ Metronic::getSVG('media/svg/icons/General/Settings-1.svg', 'svg-icon svg-icon-md svg-icon-primary') }}
                                </a>
                                <a href="{{ route('regions.edit', $region->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3"  data-toggle="tooltip" title="Edit Details">
                                    {{ Metronic::getSVG('media/svg/icons/Communication/Write.svg', 'svg-icon svg-icon-md svg-icon-primary') }}
                                </a>
                                <button type="button" class="btn btn-icon btn-light btn-hover-danger btn-sm deleteBtn" data-url="{{route('regions.destroy', $region->id)}}" data-record="{{ $region->id }}" data-placement="top"  data-toggle="tooltip" data-original-title="Delete Record">
                                    {{ Metronic::getSVG('media/svg/icons/General/Trash.svg', 'svg-icon svg-icon-md svg-icon-danger') }}
                                </button>
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
    <script src="{{ asset('js/pages/backend/region/index.js') }}" type="text/javascript" defer></script>
@endsection

@section('styles')
@endsection

