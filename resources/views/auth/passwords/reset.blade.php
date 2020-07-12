@extends('layout.auth.auth-classic-2')

@section('content')

    <!--begin::Signin-->
    <div class="login-signin text-left min-w-sm-400px">
        <form class="form" method="POST" action="{{ route('password.update') }}" id="changePasswordForm">
{{--        @csrf--}}
        <!--begin::Title-->
            <div class="mt-lg-10 pb-15">
                <h3 class="font-weight-boldest text-dark-50 display5 text-center">
                    {{ __('Reset Password') }}</h3>
            </div>
            <!--begin::Title-->
            <input type="hidden" name="token" value="{{ $token }}">
            @include('pages.widgets.auth.register._account-settings')
            <div class="form-group mt-15 d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3" id="changePasswordSubmitButton">
                    {{ __('Reset Password') }}
                </button>
                <span>or</span>
                <a href="{{ route('login') }}" class="btn btn-outline-light font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">
                    {{ __('Sign in') }}
                </a>
            </div>
        </form>
    </div>
@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script src="{{ asset('plugins/custom/formvalidation/plugins/PasswordStrength.js') }}"></script>
    <script src="{{ asset('js/pages/auth/reset-password.js') }}"></script>
@endsection

@section('ignore')

@endsection

