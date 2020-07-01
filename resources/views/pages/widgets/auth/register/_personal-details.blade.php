<!--begin::Input-->
<div class="form-group text-left">
    <input type="text" class="form-control form-control-solid form-control-lg" name="id_number" placeholder="RSA ID Number" value="" />
</div>
<!--end::Input-->

<!--begin::Input-->
<div class="form-group text-left">
    <input type="text" class="form-control form-control-solid form-control-lg" readonly name="date_of_birth" placeholder="Date of Birth" value="" />
</div>
<!--end::Input-->

<div class="row">
    <div class="col-xxl-6 col-xl-6 col-lg-6">
        <!--begin::Input-->
        <div class="form-group text-left">
            <input type="text" class="form-control form-control-solid form-control-lg" name="first_name" placeholder="First Name" value="" />
        </div>
        <!--end::Input-->
    </div>
    <div class="col-xxl-6 col-xl-6 col-lg-6">
        <!--begin::Input-->
        <div class="form-group text-left">
            <input type="text" class="form-control form-control-solid form-control-lg" name="last_name" placeholder="Last Name" value="" />
        </div>
        <!--end::Input-->
    </div>
</div>

<!--begin::Input-->
<div class="form-group text-left">
    <div class="radio-inline text-left">
        <label class="radio">
            <input type="radio" name="gender" value="M"/> Male
            <span></span>
        </label>
        <label class="radio">
            <input type="radio" name="gender" value="F"/> Female
            <span></span>
        </label>
    </div>
</div>
<!--end::Input-->

<!--begin::Input-->
<div class="form-group text-left">
    <input type="text" class="form-control form-control-solid form-control-lg" name="address" placeholder="Street Address" value="" />
</div>
<!--end::Input-->
<!--begin::Input-->
<div class="form-group text-left">
    <input type="text" class="form-control form-control-solid form-control-lg" name="city" placeholder="City" value="" />
</div>
<!--end::Input-->
<div class="row">
    <div class="col-xxl-6 col-xl-6 col-lg-6">
        <!--begin::Input-->
        <div class="form-group text-left">
            {{ Form::select('province', \App\Region::$provinces, null, ['class' => 'form-control text-dark form-control-solid kt-selectpicker', 'data-size'=>'5', 'data-live-search'=>'true']) }}
        </div>
        <!--end::Input-->
    </div>
    <div class="col-xxl-6 col-xl-6 col-lg-6">
        <!--begin::Input-->
        <div class="form-group text-left">
            <input type="text" class="form-control form-control-solid form-control-lg" name="postal_code" placeholder="Postal Code" value="" />
        </div>
        <!--end::Input-->
    </div>
</div>
