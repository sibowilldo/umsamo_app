
<!--begin::List Widget 10-->
<div class="card card-custom card-stretch gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0">
        <h3 class="card-title font-weight-bolder text-dark">Family Details</h3>
        <div class="card-toolbar">
            <button type="button" class="btn btn-light-success btn-sm font-weight-bold" data-toggle="modal" data-target="#newFamilyModal">
                New Family
            </button>
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

                    <button  data-toggle="tooltip" title="Invite Member to join" type="button" class="btn btn-icon btn-sm btn-light-primary mr-1 inviteMember" data-family-id="{{ $family->uuid }}" data-family-name="{{ $family->name }}">
                        {{ Metronic::getSvg('media/svg/icons/Communication/Add-user.svg') }}
                    </button>
                    <!--end::Btn-->
                </div>
                <!--end::Section-->
            </div>
        <!--end: Item-->
        @empty
                <div class="d-flex flex-column min-h-400px align-items-center p-5 text-center justify-content-center">
                    <div class="mr-6">
                        <span class="svg-icon svg-icon-info svg-icon-10x">
                         {{ Metronic::getSVG("media/svg/icons/Files/User-folder.svg") }}
                        </span>
                    </div>
                    <div class="d-flex flex-column">
                        <h4 class="text-dark font-weight-boldest font-size-h4 mb-3">
                            No family details found
                        </h4>
                        <div class="text-muted">
                            You are not part of any family.
                            <br>You can create one using the button at the corner,
                            <br>and invite members of the family to join.
                        </div>
                    </div>
                </div>
        @endforelse
    </div>
    <!--end: Card Body-->
</div>

<!-- Modal-->
<div class="modal fade" id="newFamilyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create a new Family Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form action="{{ route('families.store') }}" method="post" id="createFamilyForm">
            <div class="modal-body">
                    <div class="form-group">
                        <label>Family Name</label>
                        <input type="text" name="family_name" class="form-control"  placeholder="e.g oKhabazela"/>
                        <span class="form-text text-muted">Short and Meaningful</span>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-fill flex-row align-items-center justify-content-between">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Nevermind</button>
                    <button type="submit" class="btn btn-primary font-weight-bold" id="createFamilyButton">Create</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!--end: Card-->
<!--end: List Widget 10-->
