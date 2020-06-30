@extends('layout.auth')
@php $page_title = "Forgot Password" @endphp
@section('content')

    <!--begin::Forgot-->
    <div class="login-form">
        <!--begin::Form-->
        <form class="form" method="post" novalidate="novalidate" action="{{ route('password.email') }}">
            @csrf
            <!--begin::Title-->
            <div class="text-center pt-lg-40 mt-lg-20 pb-15">
                <h3 class="font-weight-bolder text-dark display5">Forgotten Password ?</h3>
                <p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password or <a
                        href="{{ route('login') }}">Sign in</a></p>
            </div>
            <!--end::Title-->
            @if (session('status'))
                <div class="alert alert-success font-weight-bolder" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <!--begin::Form group-->
            <div class="form-group">
                <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" required placeholder="Email Address" name="email" autocomplete="off" />
                @error('email')
                    <p class="invalid-feedback text-center" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                @enderror
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
