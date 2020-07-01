@extends('layout.auth.auth-classic-2')
@php $page_title = "Forgot Password" @endphp
@section('content')

    <!--begin::Forgot-->
    <div class="login-form">
        <!--begin::Form-->
        <form class="form" method="post" novalidate="novalidate" action="{{ route('password.email') }}">
            @csrf
            <!--begin::Title-->
            <div class="text-center mt-lg-20 pb-15">
                <h3 class="font-weight-bolder text-dark display5">Forgotten Password ?</h3>
                <p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password <br>or Try <a
                        href="{{ route('login') }}">Signing in</a></p>
            </div>
            <!--end::Title-->
                <div id="message" class="alert alert-success font-weight-bolder d-none" role="alert">
                    Message
                </div>
            <!--begin::Form group-->
            <div class="form-group">
                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" value="{{ old('email') }}" required placeholder="Email Address" name="email" autocomplete="off" />

            </div>
            <!--end::Form group-->
            <!--begin::Form group-->
            <div class="form-group d-flex flex-wrap flex-center pb-lg-0">
                <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">
                    {{ __('Send Password Reset Link') }}</button>
            </div>
            <!--end::Form group-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Forgot-->
@endsection


@section('scripts')
    <script src="{{ asset('js/pages/auth/email.js') }}" type="text/javascript" async></script>
@endsection
