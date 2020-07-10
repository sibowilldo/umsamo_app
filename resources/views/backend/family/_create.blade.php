<div class="card card-custom">
    <div class="card-header py-3">
        <div class="card-title align-items-start flex-column">
            <h3 class="card-label font-weight-bolder text-dark">Create Family Group</h3>
            <span class="text-muted font-weight-bold font-size-sm mt-1">Create a new family group and invite members to join.</span>
        </div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-success mr-2 font-weight-bold" id="createFamilySubmitButton">Save Changes</button>
            <button class="btn btn-secondary btn-icon">{{ Metronic::getSvg('media/svg/icons/General/Other1.svg', 'svg-icon svg-icon-primary') }}</button>
        </div>
    </div>
        <form action="#" method="post" id="createFamilyForm">
    <!--begin::Form-->
        <div class="card-body">
            <div class="form-group mb-8">
                <div class="alert alert-custom alert-default" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
                    <div class="alert-text">
                        Give your Family Group a name and add Family Members by their RSA ID Numbers. <br>
                        <strong>Important:</strong> Members of the family must already be register and have their account activated for them to be invited to join the Family Group.
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Family Name</label>
                <input type="text" name="name" class="form-control"  placeholder="e.g oKhabazela"/>
                <span class="form-text text-muted">Short and Meaningful</span>
            </div>
            <div class="form-group">
                <label>Search Member</label>
                <div class="input-group">
                    <input type="text" name="search_for" class="form-control" placeholder="13 Digits Valid RSA ID Number"/>
                    <div class="input-group-append">
                        <button class="btn btn-secondary btn-icon" type="button">
                            {{ Metronic::getSvg('media/svg/icons/General/Search.svg', 'svg-icon svg-icon-primary') }}
                        </button>
                    </div>
                </div>
                <span class="form-text text-muted">Search will begin once the ID Number has been verified</span>
            </div>
            <div class="form-group">
                <label for="exampleSelect1">Selected Members</label>
                <select name="members[]" class="form-control" id="select_members" multiple>

                </select>
            </div>
        </div>
    </form>
    <!--end::Form-->
</div>
