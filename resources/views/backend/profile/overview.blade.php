@extends('layout.default')

@section('mobile-toggle')
    <button class="mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
        <span></span>
        {{ Metronic::getSVG('media/svg/icons/Navigation/Arrow-from-left.svg') }}
    </button>
@endsection

@section('content')

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Profile Overview-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
                    @include('backend.profile.common._side-bar')
                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-lg-6">
                            @include('pages.widgets._recent-comments', ['class'=>' card-stretch gutter-b'])
                        </div>
                        <div class="col-lg-6">
                            @include('pages.widgets._user-families')
                        </div>
                    </div>
                    <!--end::Row-->

                    @include('pages.widgets._upcoming-appointments')
                </div>
                <!--end::Content-->
            </div>
            <!--end::Profile Overview-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@stop

@section('scripts')
    <script>
        jQuery(document).ready(function(){


            var generateLuhnDigit = function(inputString) {
                var total = 0;
                var count = 0;
                for (var i = 0; i < inputString.length; i++) {
                    var multiple = count % 2 + 1;
                    count++;
                    var temp = multiple * +inputString[i];
                    temp = Math.floor(temp / 10) + (temp % 10);
                    total += temp;
                }

                total = (total * 9) % 10;

                return total;
            };
            var validateIdNumber = function(idNumber) {
                var checkIDNumber = function(idNumber) {
                    var number = idNumber.substring(0, idNumber.length - 1);
                    return generateLuhnDigit(number) === +idNumber[idNumber.length - 1];
                };
                var result = {};
                result.valid = checkIDNumber(idNumber);
                return result;
            };

            let btnSendInvite = $('.inviteMember');

            btnSendInvite.on('click', function(ev){
                ev.preventDefault();
                let selected_family = $(this);
                window.swal.fire({
                    title: 'Look up Member by ID Number',
                    text: 'The Member must already be registered, and have their account verified!',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Look up',
                    showLoaderOnConfirm: true,
                    preConfirm: (id_number) => {
                        let is_valid = validateIdNumber(id_number);
                        if(!is_valid.valid){
                            swal.fire({
                                icon:  'error',
                                title: 'Invalid RSA ID Number',
                                confirmButtonText: 'Close',
                            })
                            return;
                        }

                        return axios.get(`/profiles/${id_number}`)
                                    .then(response => {
                                        if (response.status !== 200) {
                                            throw new Error(response.statusText)
                                        }
                                        return response.data.profile;
                                    })
                                    .catch(error => {
                                        swal.showValidationMessage(
                                            `${error}`
                                        )
                                    })
                    },
                    allowOutsideClick: () => !swal.isLoading()
                }).then((result) => {
                    if (result.value) {
                        let message = result.value.user.email_verified_at
                                            ? `<b>Active user since:</b>  ${moment(result.value.user.email_verified_at).format('ddd, MMM Do YYYY')}`
                                            :'Cannot Invite Unverified user!';
                        let member = result.value.fullname;
                            swal.fire({
                                title: `Found ${member}`,
                                html: `${ message }`,
                                imageUrl: result.value.avatar_url,
                                showCancelButton: true,
                                showConfirmButton: !!result.value.user.email_verified_at,
                                confirmButtonText: 'Send Invite',
                                preConfirm: () => {
                                        swal.fire({
                                            icon:  'success',
                                            title: 'Invite Sent',
                                            html:`${member} was invited to join: ${ selected_family.data('family-name') }`,
                                            confirmButtonText: 'Close',
                                        })

                                    return ;
                                    axios.get(`/profiles/${id_number}`)
                                        .then(response => {
                                            if (response.status !== 200) {
                                                throw new Error(response.statusText)
                                            }
                                            return response.data.profile;
                                        })
                                        .catch(error => {
                                            swal.showValidationMessage(
                                                `${error}`
                                            )
                                        })
                                },
                        })
                    }
                })
            })
        })
    </script>
@stop
