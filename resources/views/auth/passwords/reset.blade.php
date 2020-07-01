@extends('layout.auth.auth-classic-2')

@section('content')

    <!--begin::Signin-->
    <div class="login-signin text-left min-w-sm-350px">
        <form class="form" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <!--begin::Title-->
                            <div class="mt-lg-10 pb-15">
                                <h3 class="font-weight-boldest text-dark-50 display5">
                                    {{ __('Reset Password') }}</h3>
                            </div>
                            <!--begin::Title-->
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label for="email" class="font-size-h6 font-weight-bolder text-dark pt-5">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control form-control-solid h-auto p-6  @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="font-size-h6 font-weight-bolder text-dark pt-5">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control form-control-solid h-auto p-6  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="font-size-h6 font-weight-bolder text-dark pt-5">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control form-control-solid h-auto p-6 " name="password_confirmation" required autocomplete="new-password">

                        </div>

                        <div class="form-group mb-0 d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">
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
