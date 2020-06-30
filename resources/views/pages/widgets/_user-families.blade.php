
<!--begin::List Widget 10-->
<div class="card card-custom card-stretch gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0">
        <h3 class="card-title font-weight-bolder text-dark">Family Details</h3>
        <div class="card-toolbar">
            <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-1" data-card-tool="toggle">
                {{ Metronic::getSvg('media/svg/icons/Communication/Add-user.svg') }}
            </a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-0">
        @forelse($families as $family)
        <!--begin::Item-->
            <div class="d-flex flex-wrap align-items-center mb-10">
                <!--begin::Symbol-->
                <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4 bg-light-primary p-5">
                    {{ Metronic::getSvg('media/svg/icons/Communication/Group.svg', 'svg-icon svg-icon-info svg-icon-2x') }}
                </div>
                <!--end::Symbol-->
                <!--begin::Title-->
                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 mr-2">
                    <a href="#" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">{{ $family->name }}</a>
                    <span class="text-muted font-weight-bold">Created {{ $family->created_at->shortRelativeToNowDiffForHumans() }}</span>
                </div>
                <!--end::Title-->
                <!--begin::Section-->
                <div class="d-flex align-items-center mt-lg-0 mt-3">
                    <!--begin::Label-->
                    <div class="mr-6">
                        <span class="text-dark-75 font-weight-bolder">{{ count($family->users) }} {{ count($family->users) == 1 ? 'Member':'Members' }}</span>
                    </div>
                    <!--end::Label-->
                    <!--begin::Btn-->
                    <a href="#" class="btn btn-icon btn-light btn-sm">
                        {{ Metronic::getSvg('media/svg/icons/Navigation/Arrow-right.svg', 'svg-icon svg-icon-success svg-icon-md') }}
                    </a>
                    <!--end::Btn-->
                </div>
                <!--end::Section-->
            </div>
        <!--end: Item-->
        @empty
        @endforelse
    </div>
    <!--end: Card Body-->
</div>
<!--end: Card-->
<!--end: List Widget 10-->
