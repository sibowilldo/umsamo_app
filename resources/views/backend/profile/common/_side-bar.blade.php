
<!--begin::Profile Card-->
<div class="card card-custom card-stretch">
    <!--begin::Body-->
    <div class="card-body pt-10">
        <!--begin::User-->
        <div class="d-flex align-items-center">
            <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                <div class="symbol-label" style="background-image:url({{ asset($user->profile->avatar) }})"></div>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div>
                <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{ $user->profile->fullname }}</a>
                <div class="text-muted">{{ $user->profile->maskedidnumber }}</div>
            </div>
        </div>
        <!--end::User-->
        <!--begin::Contact-->
        <div class="py-9">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">ID Number:</span>
                <span class="text-muted mask_id_number">{{ $user->profile->maskedidnumber }}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">Date of Birth:</span>
                <span class="text-muted">{{ $user->profile->date_of_birth->format('M, d Y') }}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">Email:</span>
                <a href="#" class="text-muted text-hover-primary">{{ $user->email }}</a>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">Phone:</span>
                <span class="text-muted">{{ $user->profile->cell_number }}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <span class="font-weight-bold mr-2">Location:</span>
                <span class="text-muted">{{ $user->profile->address }}</span>
            </div>
        </div>
        <!--end::Contact-->
        <!--begin::Nav-->
        <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
            <div class="navi-item mb-2">
                <a href="{{ route('profiles.overview', $user) }}" class="navi-link py-4 {{ Request::routeIs('profiles.overview')? 'active':'' }}" >
                                        <span class="navi-icon mr-2">
                                            <span class="svg-icon">
                                                {{ Metronic::getSvg('media/svg/icons/Design/Layers.svg') }}
                                            </span>
                                        </span>
                    <span class="navi-text font-size-lg">Profile Overview</span>
                </a>
            </div>
            <div class="navi-item mb-2">
                <a href="{{ route('profiles.personal-information', $user) }}"  class="navi-link py-4 {{ Request::routeIs('profiles.personal-information')? 'active':'' }}">
                                    <span class="navi-icon mr-2">
                                        <span class="svg-icon">
                                            {{ Metronic::getSvg('media/svg/icons/General/User.svg') }}
                                        </span>
                                    </span>
                    <span class="navi-text font-size-lg">Personal Information</span>
                </a>
            </div>
{{--            <div class="navi-item mb-2">--}}
{{--                <a href="{{ route('profiles.manage-family', $user) }}"  class="navi-link py-4 {{ Request::routeIs('profiles.manage-family')? 'active':'' }}">--}}
{{--                                    <span class="navi-icon mr-2">--}}
{{--                                        <span class="svg-icon">--}}
{{--                                            {{ Metronic::getSvg('media/svg/icons/Communication/Group.svg') }}--}}
{{--                                        </span>--}}
{{--                                    </span>--}}
{{--                    <span class="navi-text font-size-lg">Manage Family</span>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="navi-item mb-2">--}}
{{--                <a href="{{ route('profiles.account-information', $user) }}"  class="navi-link py-4 {{ Request::routeIs('profiles.account-information')? 'active':'' }}">--}}
{{--                                        <span class="navi-icon mr-2">--}}
{{--                                            <span class="svg-icon">--}}
{{--                                                {{ Metronic::getSvg('media/svg/icons/Code/Compiling.svg') }}--}}
{{--                                            </span>--}}
{{--                                        </span>--}}
{{--                    <span class="navi-text font-size-lg">Account Information</span>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="navi-item mb-2">--}}
{{--                <a href="{{ route('profiles.change-password', $user) }}"  class="navi-link py-4 {{ Request::routeIs('profiles.change-password')? 'active':'' }}">--}}
{{--                                        <span class="navi-icon mr-2">--}}
{{--                                            <span class="svg-icon">--}}
{{--                                                {{ Metronic::getSvg('media/svg/icons/Communication/Shield-user.svg') }}--}}
{{--                                            </span>--}}
{{--                                        </span>--}}
{{--                    <span class="navi-text font-size-lg">Change Password</span>--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Body-->
</div>
<!--end::Profile Card-->
