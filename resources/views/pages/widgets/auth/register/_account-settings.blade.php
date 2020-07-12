<!--begin::Form group-->
<div class="form-group text-left">
    <input class="form-control form-control-solid form-control-lg" type="email" placeholder="Email" name="email" autocomplete="off" value="{{ $email ?? old('email') }}"/>
    <span class="form-text text-muted">We'll never share your email with anyone else.</span>
</div>
<!--end::Form group-->
<!--begin::Form group-->
<div class="form-group text-left">
    <input class="form-control form-control-solid form-control-lg" type="password" placeholder="Password" name="password" autocomplete="off" />
    <div class="progress mx-3" style="height: 2px; margin-top: -3px">
        <div id="passwordMeter" class="progress-bar" role="progressbar" style="width: 0%;"></div>
    </div>
</div>
<!--end::Form group-->
<!--begin::Form group-->
<div class="form-group text-left mt-15">
    <input class="form-control form-control-solid form-control-lg" type="password" placeholder="Confirm password" name="password_confirmation" autocomplete="off" />
</div>
<!--end::Form group-->
