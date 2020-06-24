@extends('layout.auth')

@section('content')

    <!--begin::Signin-->
    <div class="login-signin">
        <p class="font-weight-bolder font-size-h5 align-right text-muted">Already have an account? <a href="{{ route('login') }}">Sign in</a> or <a href="{{ route('register') }}" class="text-primary font-weight-bolder">Create an Account</a></p>
        <form class="form" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <!--begin::Title-->
                            <div class="pt-lg-40 mt-lg-10 pb-15">
                                <h3 class="font-weight-bolder text-dark display5">
                                    {{ __('Reset Password') }}</h3>
                            </div>
                            <!--begin::Title-->
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label for="email" class="font-size-h6 font-weight-bolder text-dark pt-5">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control form-control-solid h-auto py-4 px-3 rounded-lg @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="font-size-h6 font-weight-bolder text-dark pt-5">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control form-control-solid h-auto py-4 px-3 rounded-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="font-size-h6 font-weight-bolder text-dark pt-5">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control form-control-solid h-auto py-4 px-3 rounded-lg" name="password_confirmation" required autocomplete="new-password">

                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
    </div>
@endsection
