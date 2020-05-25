    @csrf
    @include('layout.forms.errors')
    <div class="form-group row">
        <label class="col-form-label text-right col-lg-3 col-sm-12">Name *</label>
        <div class="col-lg-9 col-md-9 col-sm-12">
            {{ Form::text('name', null, ['class'=>'form-control', 'placeholder' => '']) }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label text-right col-lg-3 col-sm-12">Description *</label>
        <div class="col-lg-9 col-md-9 col-sm-12">
            {{ Form::textarea('description', null, ['class' =>'form-control', 'rows'=>3]) }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label text-right col-lg-3 col-sm-12">Contact Number *</label>
        <div class="col-lg-9 col-md-9 col-sm-12">
            {{ Form::tel('contact_number', null, ['class'=>'form-control', 'placeholder' => '(012) 345-6789']) }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label text-right col-lg-3 col-sm-12">Province *</label>
        <div class="col-lg-9 col-md-9 col-sm-12">
            {{ Form::select('province', $provinces, null, ['class'=>'form-control', 'placeholder' => 'Please select a province']) }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label text-right col-lg-3 col-sm-12">Address </label>
        <div class="col-lg-9 col-md-9 col-sm-12">
            {{ Form::text('address', null, ['class'=>'form-control', 'placeholder' => '']) }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label text-right col-lg-3 col-sm-12">Latitude </label>
        <div class="col-lg-9 col-md-9 col-sm-12">
            {{ Form::text('latitude', null, ['class'=>'form-control', 'placeholder' => '']) }}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label text-right col-lg-3 col-sm-12">Longitude </label>
        <div class="col-lg-9 col-md-9 col-sm-12">
            {{ Form::text('longitude', null, ['class'=>'form-control', 'placeholder' => '']) }}
        </div>
    </div>
