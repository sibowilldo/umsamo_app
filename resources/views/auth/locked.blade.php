@extends('layout.auth.auth-classic-2')

@section('content')

    <div class="min-w-sm-400px p-8 locked rounded m-4">
        @if($token && $user)
            <!--begin::Form-->
            <form class="form" novalidate="novalidate" id="loginForm" method="POST" action="{{ route('auth.unlock.account') }}">
            @csrf
                <!--begin::Title-->
                <div class="mt-lg-10 pb-15">
                    <div class="alert alert-success">
                        <span class="font-weight-bold text-white"><strong>TO UNLOCK:</strong> Please enter your email address and click "Unlock Account"</span>
                    </div>
                </div>
                <input type="hidden" name="who" value="{{ $user }}">
                <input type="hidden" name="how" value="{{ $token }}">
                <!--begin::Form group-->
                <div class="form-group">
                    <input class="form-control form-control-solid h-auto rounded-lg py-5" type="email" name="email" autocomplete="off" placeholder="Email Address" value="" />
                </div>
                <!--end::Form group-->
                <!--begin::Action-->
                <div class="pb-lg-0 pb-10">
                    <button type="submit" id="loginSubmitButton" class="btn btn-light-primary font-weight-bold px-8 py-4 my-3 mr-3">Unlock Account</button>
                </div>
                <!--end::Action-->
            </form>
            <!--end::Form-->
        @else
            <div class="alert alert-danger mt-4">
                <span class="font-weight-bold text-white"><strong>STOP:</strong> This account is locked by its owner, <br>and can only be unlocked with a unique link that was sent to them.</span>
            </div>
        @endif
    </div>


@endsection

@section('styles')
    <style>
        .locked{
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(20px);
        }
    </style>
@endsection

@section('scripts')
{{--<script src="{{ asset("js/pages/auth/login.js") }}"></script>--}}
@endsection
